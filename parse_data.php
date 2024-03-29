<?php
class Parse_data {

    public string $lang;

    public function __construct(string $lang) 
    {
        $this->lang = $lang;
    }

    public function hh_vacs()  {
        $ch = curl_init('https://api.hh.ru/vacancies?text='.$this->lang.'&per_page=100');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); #для записи в переменную
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, true);
    
        $html = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($html, true);
        $result_data = array();
        foreach ($json['items'] as $el) {
            $temp = array();
            $temp['lang'] = 'php';
            $temp['title'] = $el['name'];
            $temp['company'] = $el['employer']['name'];
            $temp['url'] = $el['alternate_url'];
    
            if ($el['salary'] == null) {
                $temp['salary'] = "Не указана";
            }
            elseif ($el["salary"]["from"] == null) {
                $temp['salary'] = "до ".$el["salary"]["to"];
            }
            else {
                $temp['salary'] = "от ".$el['salary']['from'];
            }
    
            $temp['info'] = $el['snippet']['requirement'];
            array_push($result_data, $temp);
        }
        return json_encode($result_data);
    }

    public function geekjob_vacs()  
    {
        #в планах напистаь сюда парсер для geekjob
    }
}
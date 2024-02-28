<?php
class Parse_data {

    public string $lang;

    public function __construct(string $lang) 
    {
        $this->lang = $lang;
    }

    public function hh_vacs()  {
        $ch = curl_init('https://api.hh.ru/vacancies?text='.$this->lang);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); #для записи в переменную
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, true);

        $html = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($html, true);
        $result_data = array();
        foreach ($json['items'] as $el) {
            $temp = array();
            $temp['lang'] = $this->lang;
            $temp['title'] = $el['name'];
            $temp['company'] = $el['employer']['name'];
            $temp['url'] = $el['apply_alternate_url'];
            $temp['salary'] = "от ".$el['salary']['from'];
            $temp['info'] = $el['snippet']['requirement'];
            array_push($result_data, $temp);
    return $result_data;
    }
    }
}

$test = new Parse_data('php');


var_dump($test->hh_vacs());
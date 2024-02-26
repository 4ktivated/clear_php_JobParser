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
        $js = json_decode($html, true);
        $result_data = array();
        foreach ($js['items'] as $key => $value) {
            $temp = array();
            if ($key == 'name') {
            $temp[$key] = $value;
            } elseif ($key == 'salary') {
                $temp[$key['from']] = $value;
            }
            array_push( $result_data, $temp );
    return $result_data;
    }
    }
}

$test = new Parse_data('php');

var_dump($test->hh_vacs());
<?php

function hh_vacs()  {
    $ch = curl_init('https://api.hh.ru/vacancies?text='.'php');
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
    return $result_data;
}

var_dump(hh_vacs());
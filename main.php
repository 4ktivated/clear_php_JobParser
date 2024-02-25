<?php




$ch = curl_init('https://api.hh.ru/vacancies?text=php&per_page=2');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); #для записи в переменную
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, true);

$html = curl_exec($ch);
curl_close($ch);
$js = json_decode($html, true);
echo $js['items'][0]['name'];

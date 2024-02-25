<?php

include_once("../api/data_base.php");
include_once("../api/model.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$data_base = new DB_connection();
$sesion = $data_base->get_session();

$vacs = new VacModel($sesion);

#сюда прописать read по языку программирования 
$stmt = $vacs->read();
$num_rows = $stmt->rowCount();

if ($num_rows == 0) 
{
    $vacs_arr = array();
    $vacs_arr["vacs"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $vacs_item = array(
            'id' => $id,
            'lang' => $lang,
            'title' => $title,
            'company' => $company,
            'url' => $url,
            'salary' => $salary,
            'info' => $info,
        );
        array_push($vacs_arr['vacs'], $vacs_item);
    }
    
    http_response_code(200);
    echo json_encode($vacs_arr);
}else{
    http_response_code(404);
    echo json_encode(array('message'=> 'Данных нет'), JSON_UNESCAPED_UNICODE);

}
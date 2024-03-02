<?php

include_once("../api/data_base.php");
include_once("../api/model.php");


$data_base = new DB_connection();
$sesion = $data_base->get_session();
$vacs = new VacModel($sesion);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->description) &&
    !empty($data->category_id)
) {
    $vacs->lang = $data->lang;
    $vacs->title = $data->title;
    $vacs->company = $data->company;
    $vacs->url = $data->url;
    $vacs->salary = $data->salary;
    $vacs->info = $data->info;

    if ($vacs->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Всё хорошо"), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "Что-то совсем не так."), JSON_UNESCAPED_UNICODE);
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "Что-то чуть чуть не так."), JSON_UNESCAPED_UNICODE);
}

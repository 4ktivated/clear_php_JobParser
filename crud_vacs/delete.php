<?php

include_once("../api/data_base.php");
include_once("../api/model.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new DB_connection();
$db = $database->get_session();

$item = new VacModel($db);

$data = json_decode(file_get_contents("php://input"));

if($item->delete()){
    http_response_code(200);
    echo json_encode(array("Вакансия удаленнa"), JSON_UNESCAPED_UNICODE);
} else{
    http_response_code(503);
    echo json_encode(array("message" =>"Вакансия НЕ удалена"));
}
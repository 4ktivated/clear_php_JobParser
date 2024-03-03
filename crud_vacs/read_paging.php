<?php

include_once "../api/core.php";
include_once "../shared/utilities.php";
include_once("../api/data_base.php");
include_once("../api/model.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$utitlites = new Utilities();

$database = new DB_connection();

$db = $database->get_session();

$vacs = new VacModel($db);

$stmt = $vacs->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

if($num>0){

    $paging_arr=array();
    $paging_arr["records"]=array();
    $paging_arr["paging"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
        
        $vacs_item=array(
            "id" => $id,
            "lang" => $lang,
            "title" => $title,
            "company" => $company,
            "url" => $url,
            "salary" => $salary,
            "info" => $info
        );
        array_push($paging_arr["records"], $vacs_item);
    }

    $total_rows=$vacs->count();
    $page_url="{$home_url}vac/read_paging.php?";
    $paging = $utitlites->getPaging($page, $total_rows, $records_per_page, $page_url);
    $paging_arr["paging"]=$paging;

    http_response_code(200);
    echo json_encode($paging_arr);
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Вакансий не найденно"), JSON_UNESCAPED_UNICODE);
}
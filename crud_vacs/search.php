<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../api/core.php";
include_once "../api/database.php";
include_once "../api/model.php";

$database = new DB_connection();
$db = $database->get_session();

$product = new VacModel($db);

$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

$stmt = $product->search($keywords);
$num = $stmt->rowCount();

if ($num > 0) {
    $vacs_arr = array();
    $vacs_arr["vacs"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract ($row);
        $vacs_item = array(
            "id" => $id,
            "lang" => $lng,
            "title" => $title,
            "company" => $company,
            "url" => $url,
            "salary" => $slary,
            "info" => $info
        );
        array_push($vac_arr["vacs"], $vacs_item);
    }

    http_response_code(200);

    echo json_encode($vacs_arr);
} else {
    http_response_code(404);

    echo json_encode(
        array("message" => "Вакансий по заданному языку нет")
    );
}

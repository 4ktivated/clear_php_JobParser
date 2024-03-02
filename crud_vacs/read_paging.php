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

$product = new VacModel($db);

$stmt = $product->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
#я спать но завтра надо закончить с этим приложением
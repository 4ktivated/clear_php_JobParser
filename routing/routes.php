<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/read' :
        require '../crud_vacs/read.php';
        break;
    case '/delete' :
        require '../crud_vacs/delete.php';
        break;
    case '/create' :
        require '../crud_vacs/create.php';
        break;
}
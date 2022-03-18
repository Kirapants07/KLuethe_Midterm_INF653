<?php

//Headers to deal with CORS -- not needed in CRUD files
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

if($method == "GET"){
    require_once('read.php');
    require_once('read_single.php');
}

if ($method == "POST"){
    require_once('create.php');
}

if ($method == "PUT"){
    require_once('update.php');
}

if ($method == "DELETE"){
    require_once('delete.php');
}

//instantiate model
$author = new Author();


?>
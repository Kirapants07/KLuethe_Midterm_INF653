<?php

require_once '../../config/Database.php';
require_once '../../model/Quote.php';

//Instantiate db and connect
$database = new Database();
$db = $database->connect();

//Instantiate quote object
$newQuote = new Quote($db);

//get posted data (id)
$data = json_decode(file_get_contents("php://input"));

//check if id is specified
if (isset($data->id) && !empty($data->id))
{
    //assign variables
    $newQuote->id = $data->id;
}

//Check if delete quote entry was successful
if ($newQuote->delete()) {
    echo json_encode(array('id' => $newQuote->id));
}
else {
    echo json_encode(array('message' => 'No Quotes Found'));
}
exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
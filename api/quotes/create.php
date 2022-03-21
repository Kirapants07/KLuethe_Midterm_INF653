<?php

require_once '../../config/Database.php';
require_once '../../model/Quote.php';

//Instantiate db and connect
$database = new Database();
$db = $database->connect();

//Instantiate quote object
$newQuote = new Quote($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));

//check if quote name is specified
if (isset($data->quote) && !empty($data->quote))
{
    //assign variables
    $newQuote->quote = $data->quote;
}

//Create new quote entry
if ($newQuote->create()) {
    echo json_encode(
        array('id' => $db->lastInsertid(),
        'quote' => $newQuote->quote,
        ));
}
else {
    echo json_encode(array('message' => 'quoteId Not Found'));
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
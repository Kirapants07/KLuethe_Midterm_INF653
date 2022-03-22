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
if (isset($data->id) && isset($data->quote) && !empty($data->id) && !empty($data->id))
{
    //assign variables
    $newQuote->id = $data->id;
    $newQuote->quote = $data->quote;
}

//update quote entry
if ($newQuote->update()) {
    echo json_encode(
        array('id' => $newQuote->id,
            'quote' => $newQuote->quote,
        ));
}
else {
    echo json_encode(array('message' => 'quoteId Not Found'));
}
//if author name is not specified, Missing Parameters error message
else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
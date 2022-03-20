<?php

require_once '../../config/Database.php';
require_once '../../model/Author.php';

//Instantiate db and connect
$database = new Database();
$db = $database->connect();

//Instantiate author object
$newAuthor = new Author($db);

//get posted data (id)
$data = json_decode(file_get_contents("php://input"));

//check if id is specified
if (isset($data->id) && !empty($data->id))
{
    //assign variables
    $newAuthor->id = $data->id;
}

//Check if delete author entry was successful
if ($newAuthor->delete()) {
    echo json_encode(array('message' => $newAuthor->id));
}
else {
    echo json_encode(array('message' => 'No Quotes Found’));
}
exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
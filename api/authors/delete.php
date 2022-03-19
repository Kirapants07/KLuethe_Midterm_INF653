<?php
require '../../config/Database.php';
require '../../model/Author.php';

header('Access-Control-Allow-Methods: DELETE');

//Instantiate db and connect
$database = new Database();
$db = $database->dbConnect();

//Instantiate author object
$newAuthor = new Author($db);

//get posted data (id)
$data = json_decode(file_get_contents("php://input"));

//set ID
$newAuthor->id = $data->id;

//Check if delete author entry was successful
if ($newAuthor->delete()) {
    echo json_encode(array('message' => 'Author deleted'))
}
else {
    echo json_encode(array('message' => 'Error: Author not deleted'))
}
exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
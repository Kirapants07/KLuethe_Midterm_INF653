<?php
require '../../config/Database.php';
require '../../model/Author.php';

//Instantiate db and connect
$database = new Database();
$db = $database->dbConnect();

//Instantiate author object
$newAuthor = new Author($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));


//need to use isset() to check if author is being sent ************************************
//assign variables
$newAuthor->id = $data->id;
$newAuthor->author = $data->author;

//Check if create author entry was successful
if ($newAuthor->create()) {
    echo json_encode(array('message' => 'Post created'))
}
else {
    echo json_encode(array('message' => 'Error: Post not created'))
}





exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
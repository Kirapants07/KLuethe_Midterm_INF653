<?php

require_once '../../config/Database.php';
require_once '../../model/Author.php';

//Instantiate db and connect
$database = new Database();
$db = $database->connect();

//Instantiate author object
$newAuthor = new Author($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));


//check if author name is specified
if (isset($data->author) && !empty($data->author))
{
    //assign variables
    $newAuthor->author = $data->author;
}

//Create new author entry
if ($newAuthor->create()) {
    echo json_encode(
        array('author' => $newAuthor->author,
                'id' => $db->lastInsertid(),
        ));
}
else {
    echo json_encode(array('message' => 'authorId Not Found'));
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
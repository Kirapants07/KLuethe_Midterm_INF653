<?php
//get posted data
$data = json_decode(file_get_contents("php://input"));

//set ID
$newAuthor->id = $data->id;

//need to use isset() to check if author is being sent ************************************
//assign variables
$newAuthor->id = $data->id;
$newAuthor->author = $data->author;

//Check if update author entry was successful
if ($newAuthor->update()) {
    echo json_encode(array('message' => 'Post updated'));
}
else {
    echo json_encode(array('message' => 'Error: Post not updated'));
}
exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
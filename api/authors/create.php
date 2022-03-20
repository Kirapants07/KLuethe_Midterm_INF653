<?php

//get posted data
$data = json_decode(file_get_contents("php://input"));

//assign variables
$newAuthor->author = $data->author;

//check if author name is specified
//Create new author entry
if (isset($_GET['author']) && $newAuthor->create()) {
    echo json_encode(array('author' => $newAuthor->author,
                            'id' => $db->lastInsertid(),);
}
else {
    echo json_encode(array('message' => 'authorId Not Found'));
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
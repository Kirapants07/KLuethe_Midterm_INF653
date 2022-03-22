<?php

//get posted data
$data = json_decode(file_get_contents("php://input"));


//check if author name is specified
if (isset($data->id) && isset($data->author) && !empty($data->id) && !empty($data->id))
{
    //assign variables
    $newAuthor->id = $data->id;
    $newAuthor->author = $data->author;

    //update author entry
    if ($newAuthor->update()) {
        echo json_encode(
            array('id' => $newAuthor->id,
                'author' => $newAuthor->author,
            ));
    }
    else {
        echo json_encode(array('message' => 'authorId Not Found'));
    }
}
else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
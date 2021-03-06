<?php

//get posted data (id)
$data = json_decode(file_get_contents("php://input"));

//assign variables
$newAuthor->id = $data->id;

//check if id is specified
if (isset($data->id) && !empty($data->id))
{
    //Check if delete author entry was successful
    if ($newAuthor->delete()) {
        echo json_encode(array('id' => $newAuthor->id));
    }
    else {
        echo json_encode(array('message' => 'No Quotes Found'));
    }
}
//if author id is not specified, Missing Parameters error message
else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
}


exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
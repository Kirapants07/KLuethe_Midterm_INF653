<?php

//get posted data (id)
$data = json_decode(file_get_contents("php://input"));

//check if id is specified
if (isset($data->id) && !empty($data->id))
{
    //assign variables
    $newCategory->id = $data->id;
}

//Check if delete category entry was successful
if ($newCategory->delete()) {
    echo json_encode(array('id' => $newCategory->id));
}
else {
    echo json_encode(array('message' => 'No Quotes Found'));
}
exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
<?php

//get posted data (id)
$data = json_decode(file_get_contents("php://input"));

//check if id is specified
if (isset($data->id) && !empty($data->id))
{
    //assign variables
    $newQuote->id = $data->id;

    //check if id exists in database
    if (!isValid($data->id,$newQuote)){
        echo json_encode(array('message' => 'No Quotes Found'));
    }
    else {
        //Check if delete quote entry was successful
        if ($newQuote->delete()) {
            echo json_encode(array('id' => $newQuote->id));
        }
        else {
            echo json_encode(array('message' => 'No Quotes Found'));
        }
    }
}
//if author name is not specified, Missing Parameters error message
else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
}
exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
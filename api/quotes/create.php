<?php

//get posted data
$data = json_decode(file_get_contents("php://input"));



//check if quote name is specified
if (isset($data->quote) && !empty($data->quote) && isset($data->authorId) && !empty($data->authorId) && isset($data->categoryId) && !empty($data->categoryId))
{
    //assign variables
    $newQuote->quote = $data->quote;
    $newQuote->authorId = $data->authorId;
    $newQuote->categoryId = $data->categoryId;
    
    //check if authorId exists in database
    if (!isValid($data->authorId,$newAuthor)){
        echo json_encode(array('message' => 'authorId Not Found'));
    }
    //check if categoryId exists in database
    else if (!isValid($data->categoryId,$newCategory)){
        echo json_encode(array('message' => 'categoryId Not Found'));
    }

    //if both are valid
    else {


        //Create new quote entry
        if ($newQuote->create()) {
            echo json_encode(
                array('id' => $db->lastInsertid(),
                'quote' => $newQuote->quote,
                'authorId' => $newQuote->authorId,
                'categoryId' => $newQuote->categoryId,
                ));
        }
        else {
            echo json_encode(array('message' => 'quoteId Not Found'));
        }
    }
}
//if author name is not specified, Missing Parameters error message
else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
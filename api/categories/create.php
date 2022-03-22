<?php

require_once '../../config/Database.php';
require_once '../../model/Category.php';

//Instantiate db and connect
$database = new Database();
$db = $database->connect();

//Instantiate category object
$newCategory = new Category($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));

//check if category name is specified
if (isset($data->category) && !empty($data->category))
{
    //assign variables
    $newCategory->category = $data->category;

    //Create new category entry
    if ($newCategory->create()) {
        echo json_encode(
            array('id' => $db->lastInsertid(),
            'category' => $newCategory->category,
            ));
    }
    else {
        echo json_encode(array('message' => 'categoryId Not Found'));
    }
}
//if author name is not specified, Missing Parameters error message
else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
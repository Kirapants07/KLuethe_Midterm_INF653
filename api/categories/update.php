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
if (isset($data->id) && isset($data->category) && !empty($data->id) && !empty($data->id))
{
    //assign variables
    $newCategory->id = $data->id;
    $newCategory->category = $data->category;

    //update category entry
    if ($newCategory->update()) {
        echo json_encode(
            array('id' => $newCategory->id,
                'category' => $newCategory->category,
            ));
    }
    else {
        echo json_encode(array('message' => 'categoryId Not Found'));
    }
}
else {
    echo json_encode(array('message' => 'Missing Required Parameters'));
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
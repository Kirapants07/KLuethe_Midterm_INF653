<?php

require_once '../../config/Database.php';
require_once '../../model/Category.php';

//If id is specified, only read_single category
if (isset($_GET['id'])){
    require_once 'read_single.php'; 
} 
//If no url is specified, read all categorys
else {

    //Instantiate db and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate category object
    $newCategory = new Category($db);

    //get all Category
    $allCategories = $newCategory->read();

    //if there are categorys, post array
    if ($allCategories->rowCount() > 0)
    {
        $allCategories_array = array();

         //loop through all rows
         while ($row = $allCategories->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $category_item = array (
                'id' => $id,
                'category' => $category,
            );

            //Push to data element within array
            array_push($allCategories_array, $category_item);

            //output
            echo $allCategories_array;
        }
    } else {
        //No authors
        
        echo array(json_encode('message' => 'categoryId Not Found'));
    }
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request


?>
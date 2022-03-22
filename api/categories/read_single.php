<?php

//Get ID from URL. If no id is set, then do nothing
$newCategory->id = $_GET['id'];

//Get category
$newCategory->read_single();

//check if results were
if ($newCategory->id !== null)
{
    //Create Array
    $category_arr = array(
        'id' => $newCategory->id,
        'category' => $newCategory->category,
    );

    //Convert to JSON
    print_r(json_encode($category_arr));
}
else {
    //No categorys
    echo json_encode(array('message' => 'categoryId Not Found'));
}

exit();
?>
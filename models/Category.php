<?php
//get value of HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

class Categories {
    private $connection; 
    private $table = 'categories';

    //tables fields
    public $id;
    public $category;

}


?>
<?php
// Needs to join tables in query to return author name and category name *************************










//get value of HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

class Quote {
    private $connection; 
    private $table = 'quotes';

    //tables fields
    public $id;
    public $quote;
    public $authorId;
    public $categoryId;

    //Constructor with DB
    public function __construct($db) {
        $this->connection = $db;
    }

}


?>
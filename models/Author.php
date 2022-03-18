<?php

//get value of HTTP request method
$method = $_SERVER['REQUEST_METHOD'];


class Author {
    private $connection; 
    private $table = 'authors';

    //tables fields
    public $id;
    public $author;

    //Constructor with DB
    public function __construct($db) {
        $this->connection - $db;
    }

    //Get prepared statement to get Authors
    public function read() {
        //SQL Query
        $sql = 'SELECT * FROM ' . $this->table;
        //Prepared statement
        $stmt = $this->connection->prepare($sql);
        //execute query
        $stmt->execute();
        return $stmt;
    }


}


?>

<?php

//get value of HTTP request method
//$method = $_SERVER['REQUEST_METHOD'];


class Author {
    private $connection; 
    //Table
    private $table = 'authors';

    //Table columns
    public $id;
    public $author;

    //Constructor with DB
    public function __construct($db) {
        $this->connection - $db;
    }

    //Get all Authors
    public function read() {
        //query
        $sql = "SELECT * FROM {$this->table}";
        //Perpare statement with query
        $stmt = $this->connection->prepare($sql);
        //Execute query
        $stmt->execute(); //return value = true or false
        return $stmt;
    }

    public function readSingle($id) {
        //query
        $sql = 'SELECT author FROM {$this->table} WHERE id = :id';
        //Perpare statement with query
        $stmt = $this->connection->prepare($sql);
        //Bind ID variable to prepared statement
        $stmt->bindParam(':id', $id);
        //Execute query
        $stmt->execute(); //executed with WHERE id = $id

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->author = $row['author'];
        }
    }


}


?>

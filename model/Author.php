<?php

class Author {
    private $connection; 
    //Table
    private $table = 'authors';

    //Table columns
    public $id;
    public $author;

    //Constructor with DB
    public function __construct($db) {
        $this->connection = $db;
    }

    //Read all authors, and return as JSON data
    public function read() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "SELECT * FROM {$this->table}";
            //Perpare statement with query
            $stmt = $this->connection->prepare($sql);
            //Execute query
            $stmt->execute(); //return value = true or false
            return $stmt;

            //**************May need to convert to JSON data  */
        } catch {
            echo "Failed to read";
        }
    }

    //Read author with given id and return as JSON data
    public function readSingle($id) {

        //try to prepare and execute sql statement
        try {  
            //query
            $sql = "SELECT author FROM {$this->table} WHERE id = :id";
            //Perpare statement with query
            $stmt = $this->connection->prepare($sql);
            //Bind ID variable to prepared statement
            $stmt->bindParam(':id', $id);
            //Execute query
            $stmt->execute(); //executed with WHERE id = $id

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->author = $row['author'];
        } catch {
            echo "Failed to read";
        }
    }

    //Create new author entry, return new entry as JSON data
    public function create() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "INSERT INTO {this->$table} 
            SET
                id = :id,
                author = :author,";
            
            //Prepare statement
            $stmt = $this->connection->prepare($sql);

            //Sanitize user input
            //not sure if variable name is correct HERE ******************
            $this->id = filter_input(INPUT_GET, {$this->id}, FILTER_SANITIZE_STRING); 
            $this->author = filter_input(INPUT_GET, {$this->author}, FILTER_SANITIZE_STRING); 

            //Bind parameters
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);

            //Check if query executes correctly
            if ($stmt->execute()){
                return true;
            } else {
                printf("Error: %s. \n", $stmt->error);
                return false;
            }
            //$id = LAST_INSERT_ID(); //find last used ID or $id = $db->lastInsertID();
        } catch {
            echo "Failed to Create new entry";
        }

    }

    //Update existing author with given id, return updated entry as JSON data
    public function update($id) {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "UPDATE {this->$table} 
            SET
                author = :author,
            WHERE 
                id = :id,";
            
            //Prepare statement
            $stmt = $this->connection->prepare($sql);

            //Sanitize user input
            //not sure if variable name is correct HERE ******************
            $this->id = filter_input(INPUT_GET, {$this->id}, FILTER_SANITIZE_STRING); 
            $this->author = filter_input(INPUT_GET, {$this->author}, FILTER_SANITIZE_STRING); 

            //Bind parameters
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':author', $this->author);

            //Check if query executes correctly
            if ($stmt->execute()){
                return true;
            } else {
                printf("Error: %s. \n", $stmt->error);
                return false;
            }
            //$id = LAST_INSERT_ID(); //find last used ID or $id = $db->lastInsertID();
        } catch {
            echo "Failed to Create new entry";
        }

    }

    //delete existing author eith given id, return id as JAON data
    public function delete($id){
            //try to prepare and execute sql statement
            try {
            } catch {
                echo "Failed to Create new entry";
            }

        return json_encode($id);
    }


}


?>

<?php

class Category {
    private $connection; 
    //Table
    private $table = 'categories';

    //Table columns
    public $id;
    public $category;

    //Constructor with DB
    public function __construct($db) {
        $this->connection = $db;
    }

    //Read all authors, and return as JSON data
    public function read() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "SELECT * FROM {$this->table} ORDER BY id";
            //Perpare statement with query
            $stmt = $this->connection->prepare($sql);
            //Execute query
            $stmt->execute(); //return value = true or false
            return $stmt;
        } catch (Exception $e) {
            echo "Failed to read";
        }
    }

    //Read author with given id and return as JSON data
    public function read_single() {

        //try to prepare and execute sql statement
        try {  
            //query
            $sql = "SELECT id, category FROM {$this->table} WHERE id = :id";
            //Perpare statement with query
            $stmt = $this->connection->prepare($sql);
            //Bind ID variable to prepared statement
            $stmt->bindParam(':id',  $this->id);
            //Execute query
            $stmt->execute(); //executed with WHERE id = $id

            //fetch associative array
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //check for null values
            if (isset($row['id'])){
                //set properties
                $this->id = $row['id'];
                $this->category = $row['category'];

                return true;
            }
            return false;

        } catch (Exception $e) {
            echo "Failed to read";
            return false;
        }
    }

    //Create new author entry, return new entry as JSON data
    public function create() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "INSERT INTO {$this->table} 
            SET
                category = :category";
            
            //Prepare statement
            $stmt = $this->connection->prepare($sql);

            //Sanitize user input
            //$this->id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING); 
            $this->category = htmlspecialchars(strip_tags($this->category)); 

            //Bind parameters
            //$stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':category', $this->category);

            //Check if query executes correctly
            if ($stmt->execute()){
                return true;
            } else {
                printf("Error: %s. \n", $stmt->error);
                return false;
            }
            //$id = LAST_INSERT_ID(); //find last used ID or $id = $db->lastInsertID();
        } catch (Exception $e) {
            //echo "Failed to Create new entry";
        }

    }

    //Update existing author with given id, return updated entry as JSON data
    public function update() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "UPDATE {$this->table} 
            SET
            category = :category
            WHERE 
                id = :id";
            
            //Prepare statement
            $stmt = $this->connection->prepare($sql);

            //Sanitize user input
            $this->id = htmlspecialchars(strip_tags($this->id)); 
            $this->category = htmlspecialchars(strip_tags($this->category));  

            //Bind parameters
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':category', $this->category);

            //Check if query executes correctly
            if ($stmt->execute()){
                return true;
            } else {
                printf("Error: %s. \n", $stmt->error);
                return false;
            }
            //$id = LAST_INSERT_ID(); //find last used ID or $id = $db->lastInsertID();
        } catch (Exception $e) {
            echo "Failed to update entry";
        }
    }

    //delete existing author eith given id, return id as JAON data
    public function delete(){
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "DELETE FROM {$this->table}
                    WHERE id = :id";

            //prepare statement
            $stmt = $this->connection->prepare($sql);

            //Sanitize id
            $this->id = htmlspecialchars(strip_tags($this->id)); 

            //Bind ID variable to prepared statement
            $stmt->bindParam(':id', $this->id);

            //Execute query
            $stmt->execute(); //executed with WHERE id = $id
            return true;
        } catch (Exception $e) {
            echo "Failed to delete entry";
            return false;
        }
}
}
?>

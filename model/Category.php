<?php

class Category {
    private $connection; 
    //Table
    private $table = 'category';

    //Table columns
    public $id;
    public $category;

    //Constructor with DB
    public function __construct($db) {
        $this->connection = $db;
    }

    //Read all categorys, and return as JSON data
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
        } catch (Exception $e) {
            echo "Failed to read";
        }
    }

    //Read category with given id and return as JSON data
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

            //set properties
            $this->id = $row['id'];
            $this->category = $row['category'];
        } catch (Exception $e) {
            echo "Failed to read";
        }
    }

    //Create new category entry, return new entry as JSON data
    public function create() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "INSERT INTO {$this->table} 
            SET
                id = :id,
                category = :category,";
            
            //Prepare statement
            $stmt = $this->connection->prepare($sql);

            //Sanitize user input
            $this->id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING); 
            $this->category = filter_input(INPUT_GET, "category", FILTER_SANITIZE_STRING); 

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
            echo "Failed to Create new entry";
        }

    }

    //Update existing category with given id, return updated entry as JSON data
    public function update($id) {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "UPDATE {$this->table} 
            SET
                category = :category,
            WHERE 
                id = :id,";
            
            //Prepare statement
            $stmt = $this->connection->prepare($sql);

            //Sanitize user input
            $this->id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING); 
            $this->category = filter_input(INPUT_GET, "category", FILTER_SANITIZE_STRING); 

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
            echo "Failed to Create new entry";
        }

    }

    //delete existing category eith given id, return id as JAON data
    public function delete($id){
            //try to prepare and execute sql statement
            try {
                //query
                $sql = "DELETE FROM {$this->table}
                        WHERE id = :id";

                //prepare statement
                $stmt = $this->connection->prepare($sql);

                //Sanitize id
                $this->id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING); 


                //Bind ID variable to prepared statement
                $stmt->bindParam(':id', $this->id);
                //Execute query
                $stmt->execute(); //executed with WHERE id = $id
            } catch (Exception $e) {
                echo "Failed to delete entry";
            }
        return json_encode($id);
    }
}
?>

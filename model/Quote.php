<?php

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

    // Needs to join tables in query to return authorname and category name *************************
    //Read all quotes, and return as JSON data
    public function read() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "SELECT q.id, q.quote, a.author, c.category 
                    FROM quotes AS q
                            JOIN  authors as a 
                                ON a.id = q.authorId
                            JOIN categories as c
                                ON c.id = q.categoryId
                                ORDER BY q.id";
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
            $sql = "SELECT q.id, q.quote, a.author, c.category 
            FROM quotes AS q
                    JOIN  authors as a 
                        ON a.id = q.authorId
                    JOIN categories as c
                        ON c.id = q.categoryId
                         WHERE q.id = :id";
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
                $this->quote = $row['quote'];
                $this->author = $row['author'];
                $this->category = $row['category'];

                return true;
            }
            return false;

        } catch (Exception $e) {
            echo "Failed to read";
            return false;
        }
    }
        //Read author with given id and return as JSON data
        public function read_authorId() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "SELECT q.id, q.quote, a.author, c.category 
                    FROM quotes AS q
                            JOIN  authors as a 
                                ON a.id = q.authorId
                            JOIN categories as c
                                ON c.id = q.categoryId
                            WHERE q.authorId = :authorId";
            //Perpare statement with query
            $stmt = $this->connection->prepare($sql);
            //Bind authorId variable to prepared statement
            $stmt->bindParam(':authorId',  $this->authorId);
            //Execute query
            $stmt->execute(); //return value = true or false
            return $stmt;
        } catch (Exception $e) {
            echo "Failed to read";
        }
    }

        //Read author with given id and return as JSON data
        public function read_categoryId() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "SELECT q.id, q.quote, a.author, c.category 
                    FROM quotes AS q
                            JOIN  authors as a 
                                ON a.id = q.authorId
                            JOIN categories as c
                                ON c.id = q.categoryId
                            WHERE q.categoryId = :categoryId";
            //Perpare statement with query
            $stmt = $this->connection->prepare($sql);
            //Bind categoryId variable to prepared statement
            $stmt->bindParam(':categoryId',  $this->categoryId);
            //Execute query
            $stmt->execute(); //return value = true or false
            return $stmt;
        } catch (Exception $e) {
            echo "Failed to read";
        }
    }

        //Read author with given id and return as JSON data
        public function read_categoryId_authorId() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "SELECT q.id, q.quote, a.author, c.category 
                    FROM quotes AS q
                            JOIN  authors as a 
                                ON a.id = q.authorId
                            JOIN categories as c
                                ON c.id = q.categoryId
                            WHERE q.categoryId = :categoryId
                            AND q.authorId = :authorId";
            //Perpare statement with query
            $stmt = $this->connection->prepare($sql);
            //Bind categoryId variable to prepared statement
            $stmt->bindParam(':categoryId',  $this->categoryId);
            $stmt->bindParam(':authorId',  $this->authorId);
            //Execute query
            $stmt->execute(); //return value = true or false
            return $stmt;
        } catch (Exception $e) {
            echo "Failed to read";
        }
    }

    //Create new author entry, return new entry as JSON data
    public function create() {
        //try to prepare and execute sql statement
        try {
            //query
            $sql = "INSERT INTO {$this->table} 
            SET
                quote = :quote,
                authorId = :authorId,
                categoryId = :categoryId";
            
            //Prepare statement
            $stmt = $this->connection->prepare($sql);

            //Sanitize user input
            $this->quote = htmlspecialchars(strip_tags($this->quote));  
            $this->authorId = htmlspecialchars(strip_tags($this->authorId)); 
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId)); 

            //Bind parameters
            //$stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);

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
                quote = :quote,
                authorId = :authorId,
                categoryId = :categoryId
            WHERE 
                id = :id";
            
            //Prepare statement
            $stmt = $this->connection->prepare($sql);

            //Sanitize user input
            $this->id = htmlspecialchars(strip_tags($this->id));  
            $this->quote = htmlspecialchars(strip_tags($this->quote));  
            $this->authorId = htmlspecialchars(strip_tags($this->authorId)); 
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId)); 

            //Bind parameters
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);

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







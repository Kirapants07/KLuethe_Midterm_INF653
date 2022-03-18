<?php 

class Database {
    
    private $host = 'm7az7525jg6ygibs.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
    private $user = 'w6zf2cbuuhpaanb5';
    private $password = getenv($password);
    private $dbname = 'ttyw871lavputc97';
    private $connection;

    public function dbConnect() {
        this-$connection = null; //disconnect from any previous connection
    
        try {
            $connection = new PDO("mysql:host= {$this->$host};dbname= {$this->$dbname}", $this->$user, $this->$password);
            //set PDO error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to Database";
        } catch (PDOexception $e) {
            echo "Conection to Database Failed:" . $e->getMessage();
            exit();
        }
        return $this-> $connection; 
    }
}
?>
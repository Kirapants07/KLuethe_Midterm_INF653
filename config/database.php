<?php 

class Database {
    
    private $connection;

    public function dbConnect() {
        
        //use JAWSDB_URL to get connection info
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
        
        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');

        this-$connection = null; //disconnect from any previous connection
    
        try {
            $connection = new PDO("mysql:host= $host;dbname= $dbname", $user, $password);
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
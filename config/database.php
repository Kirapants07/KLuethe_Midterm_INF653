<?php 
class Database {
    
    private $connection;

    public function dbConnect() {
        
        //use JAWSDB_URL to get connection info
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
        
        $host = $dbparts['host'];
        $user = $dbparts['user'];
        $password = $dbparts['pass'];
        $dbname = ltrim($dbparts['path'],'/');

        $this->$connection = null; //disconnect from any previous connection
    
        try {
            $this->$connection = new PDO("mysql:host= $host;dbname= $dbname", $user, $password);
            //set PDO error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to Database";
        } catch (PDOexception $e) {
            echo "Connection to Database Failed:" . $e->getMessage();
            //exit();
        }
        return $this->$connection; 
    }
}
?>




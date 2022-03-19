<?php 
class Database {
    private $conn;

    public function connect() {
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);

        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');

        $this->conn = null; //disconnect from any previous connection
    
        try {
            $this->conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            return $this->conn;
        } catch(PDOException $e) {
            echo "Connection to Database Failed:" . $e->getMessage();
        }
    }
}
?>




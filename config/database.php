<?php 
class Database {
    private $url;

    public function __construct($db) {
        //use JAWSDB_URL to get connection info
        $this->url = getenv('JAWSDB_URL');
    }

    public function connect() {
        
        $dbparts = parse_url($url);

        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');

        $conn = null; //disconnect from any previous connection
    
        try {
            $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            return $conn;
        } catch(PDOException $e) {
            echo "Connection to Database Failed:" . $e->getMessage();
            //exit();
        }
    }
}
?>




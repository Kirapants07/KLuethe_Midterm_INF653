<?php 
class Database {
    
    private $connection;
    private $url;

    public function __construct($db) {
        //use JAWSDB_URL to get connection info
        $this->url = getenv('JAWSDB_URL');
    }

    public function dbConnect() {
        
        $dbparts = parse_url($this->url);
        
        $host = $dbparts['host'];
        $user = $dbparts['user'];
        $password = $dbparts['pass'];
        $dbname = ltrim($dbparts['path'],'/');

        $this->connection = null; //disconnect from any previous connection
    
        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            //set PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to Database";
        } catch(PDOException $e) {
            echo "Connection to Database Failed:" . $e->getMessage();
            //exit();
        }
        return $this->connection; 
    }
}
?>




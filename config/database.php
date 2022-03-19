<?php 
class Database {
    private $conn;
    private $url;
    private $dbparts;

    public function __construct(){
        $this->url = getenv('JAWSDB_URL');
        $this->dbparts = parse_url($this->url);
    }

    public function connect() {

        $hostname = $this->dbparts['host'];
        $username = $this->dbparts['user'];
        $password = $this->dbparts['pass'];
        $database = ltrim($this->dbparts['path'],'/');

        $this->conn = null; //disconnect from any previous connection
    
        try {
            $this->conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection to Database Failed:" . $e->getMessage();
        }
        return $this->conn;
    }
}
?>




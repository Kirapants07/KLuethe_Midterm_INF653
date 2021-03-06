<?php 
class Database {
    private $conn;
    private $url;

    function __construct(){
        $this->url = getenv('JAWSDB_URL');
        $this->conn = null; //disconnect from any previous connection
    }

    public function connect() {

        $dbparts = parse_url($this->url);

        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');

        try {
            $this->conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>


<?php 
class Database {
    private $conn;
    private $url;
    
    function __construct(){
        $this->url = getenv('JAWSDB_URL');
        $this->conn = null; //disconnect from any previous connection
    }
   
}
?>


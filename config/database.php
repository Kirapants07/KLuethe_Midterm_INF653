<?php 

//need to wrap in try Statement
//wrap in function?

$host = 'm7az7525jg6ygibs.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$user = 'w6zf2cbuuhpaanb5';
$password = getenv($password);
$dbname = 'ttyw871lavputc97';

try {
    $connection = new PDO("mysql:host = $host;dbname= $dbname", $user, $password);

    //PDO error mode is exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    echo "Connected to Database";
} catch (PDOexception $e) {
    echo "Coonection to Database Failed:" . $e->getMessage();
}



?>
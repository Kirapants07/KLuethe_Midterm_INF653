<?php

require_once '../../config/Database.php';
require_once '../../model/Author.php';

//Instantiate db and connect
$database = new Database();
$db = $database->connect();

//Instantiate author object
$newAuthor = new Author($db);

//Get ID from URL. If no id is set, then do nothing
$newAuthor->id = $_GET['id'];

//Get Author
$newAuthor->read_single();

//Create Array
$author_arr = array(
    'id' => $newAuthor->id,
    'author' => $newAuthor->author,
);

//Convert to JSON
print_r(json_encode($author_arr));

exit();
?>
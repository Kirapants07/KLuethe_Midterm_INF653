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

//check if results were returned
if (isset($data->author) && !empty($data->author)
{
    //Create Array
    $author_arr = array(
        'id' => $newAuthor->id,
        'author' => $newAuthor->author,
    );
}
else {
    //No authors
    echo json_encode(array('message' => 'authorId Not Found'));
}

//Convert to JSON
print_r(json_encode($author_arr));

exit();
?>
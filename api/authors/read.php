<?php

require_once '../../config/Database.php';
require_once '../../model/Author.php';

//If id is specified, only read_single author
if (isset($_GET['id'])){
    require_once 'read_single.php'; 
} 
//If no url is specified, read all authors
else {

    //Instantiate db and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate author object
    $newAuthor = new Author($db);

    //get all authors
    $allAuthors = $newAuthor->read();

    //if there are authors, post array
    if ($allAuthors->rowCount() > 0)
    {
        $authors_arr = $allAuthors->fetchAll(PDO::FETCH_ASSOC);

        //Convert to JSON and output
        echo json_encode(array(authors_arr));

    } else {
        //No authors
        
        echo json_encode(array('message' => 'authorId Not Found'));
    }
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request


?>
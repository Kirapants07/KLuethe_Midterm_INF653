<?php


require('../config/Database.php');
require('../model/Author.php');

//Instantiate db
$database = new Database();
//connect db object
$db = $database->dbConnect();

//Instantiate author object connected to db
$author = new Author($db);

//get all authors
$allAuthors = $author->read();

//if there are authors, post array
if ($allAuthors->rowCount() > 0)
{
    $allAuthors_array = array();
    $allAuthors_array['data'] = array();

    //
    while ($row = $author->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $

    }
} else {
    //No authors
    echo json_encode(array('message' => 'No Authors'));
}

?>
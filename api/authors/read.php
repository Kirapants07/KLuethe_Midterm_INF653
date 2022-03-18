<?php


require('../config/Database.php');
require('../model/Author.php');
require('read_single.php'); //conditional logic will route if needed

/*you are going to route to a read file based on the http GET method. 
In that file, you will likely use conditional logic - maybe based on a parameter received -
 to determine if you need to read all or read one. */




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



exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
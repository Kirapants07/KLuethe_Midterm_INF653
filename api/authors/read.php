<?php


require '../../config/Database.php';
require '../../model/Author.php';
require 'read_single.php'; //conditional logic will route if needed

/*you are going to route to a read file based on the http GET method. 
In that file, you will likely use conditional logic - maybe based on a parameter received -
 to determine if you need to read all or read one. */



//Instantiate db and connect
$database = new Database();
$db = $database->dbConnect();

//Instantiate author object
$newAuthor = new Author($db);
//get all authors
$allAuthors = $newAuthor->read();

//if there are authors, post array
if ($allAuthors->rowCount() > 0)
{
    $allAuthors_array = array();
    $allAuthors_array['data'] = array();

    //loop through all rows
    while ($row = $author->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $author_item = array (
            'id' => $id,
            'author' => $author,
        );

        //Push to data element within array
        array_push($authors_arr['data'], $author_item);

        //Convert to JSON and output
        echo json_encode($allAuthors_array);
    }
} else {
    //No authors
    echo json_encode(array('message' => 'authorId Not Found'));
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
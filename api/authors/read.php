<?php

require_once '../../config/Database.php';
require_once '../../model/Author.php';

//If id is specified, only read_single author
if (isset($_GET['id'])){
    require_once 'read_single.php'; 
} 

//If no url is specified, read all authors
else {
    //get all authors
    $allAuthors = $newAuthor->read();

    //if there are authors, post array
    if ($allAuthors->rowCount() > 0)
    {
        $allAuthors_array = array();

        //loop through all rows
        while ($row = $allAuthors->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $author_item = array (
                'id' => $id,
                'author' => $author,
            );

            //Push to data element within array
            array_push($allAuthors_array, $author_item);
        }
            //Convert to JSON and output
            echo json_encode($allAuthors_array);
    
    } else {
        //No authors
        echo json_encode(array('message' => 'authorId Not Found'));
    }
}
exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
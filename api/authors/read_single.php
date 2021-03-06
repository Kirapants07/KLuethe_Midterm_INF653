<?php

//Get ID from URL. If no id is set, then do nothing
$newAuthor->id = $_GET['id'];

//Get Author
$newAuthor->read_single();

//check if results were
if ($newAuthor->author !== null)
{
    //Create Array
    $author_arr = array(
        'id' => $newAuthor->id,
        'author' => $newAuthor->author,
    );

    //Convert to JSON
    print_r(json_encode($author_arr));
}
else {
    //No authors
    echo json_encode(array('message' => 'authorId Not Found'));
}

exit();
?>
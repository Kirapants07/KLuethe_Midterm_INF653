<?php

//Instantiate db and connect
$database = new Database();
$db = $database->connect();

//Instantiate quote object
$newQuote = new Quote($db);

//Get ID from URL. If no id is set, then do nothing
$newQuote->id = $_GET['id'];

//Get Quote
$newQuote->read_single();

//check if results were
if ($newQuote->id !== null)
{
    //Create Array
    $quote_arr = array(
        'id' => $newQuote->id,
        'quote' => $newQuote->quote,
        'author' => $newQuote->author,
        'category' => $newQuote->category,
    );

    //Convert to JSON
    print_r(json_encode($quote_arr));
}
else {
    //No authors
    echo json_encode(array('message' => 'No Quotes Found'));
}

exit();
?>
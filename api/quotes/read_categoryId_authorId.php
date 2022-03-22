<?php

require_once '../../config/Database.php';
require_once '../../model/Quote.php';

//Instantiate db and connect
$database = new Database();
$db = $database->connect();

//Instantiate quote object
$newQuote = new Quote($db);

//Get ID from URL. If no id is set, then do nothing
$newQuote->categoryId = $_GET['categoryId'];
$newQuote->authorId = $_GET['authorId'];

//get all quotes
$allQuotes = $newQuote->read_categoryId_authorId();

//if there are quotes, post array
if ($allQuotes->rowCount() > 0)
{
    $allQuotes_array = array();

    //loop through all rows
    while ($row = $allQuotes->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $quote_item = array (
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category,
        );

        //Push to data element within array
        array_push($allQuotes_array, $quote_item);
    }
        //Convert to JSON and output
        echo json_encode($allQuotes_array);

} else {
    //No quotes
    echo json_encode(array('message' => 'quoteId Not Found'));
}

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
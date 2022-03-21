<?php

require_once '../../config/Database.php';
require_once '../../model/Quote.php';

//If id is specified, only read_single quote
if (isset($_GET['id'])){
    require_once 'read_single.php'; 
} 

//If no url is specified, read all quotes
else {
    //Instantiate db and connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate quote object
    $newQuote = new Quote($db);

    //get all quotes
    $allQuotes = $newQuote->read();

    //if there are quotes, post array
    if ($allQuotes->rowCount() > 0)
    {
        $allQuotes_array = array();
       // $allQuotes_array['data'] = array();

        //loop through all rows
        while ($row = $allQuotes->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $quote_item = array (
                'id' => $newQuote->id,
                'quote' => $newQuote->quote,
                'authorid' => $newQuote->authorid,
                'categoryid' => $newQuote->categoryid,
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
}
exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
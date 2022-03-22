<?php

//If id is specified, only read_single quote
if (isset($_GET['id'])){
    require_once 'read_single.php'; 
} 

//If categoryId and authorId both specified
if (isset($_GET['categoryId']) && isset($_GET['authorId'])){
    require_once 'read_categoryId_authorId.php'; 
} 

//If authorId is specified
if (isset($_GET['authorId']) && !isset($_GET['categoryId'])){
    require_once 'read_authorId.php'; 
} 

//If categoryId is specified
if (isset($_GET['categoryId']) && !isset($_GET['authorId'])){
    require_once 'read_categoryId.php'; 
} 


//If no url is specified, read all quotes
else {

    //get all quotes
    $allQuotes = $newQuote->read();

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
}
exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
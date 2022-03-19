<?php
require '../../config/Database.php';
require '../../model/Author.php';

header('Access-Control-Allow-Methods: GET');

exit(); //prevent accidentally attempting to complete more than one operation per HTTP request
?>
<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
     Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/quotes.php';

    $database = new database();
    $db = $database->connect();

    $quote = new quotes($db);

    $data = json_decode(file_get_contents("php://input"));

    $quote->quote = $data->quote;
    $quote->categoryId = $data->categoryId;
    $quote->authorId = $data->authorId;

    if($quote->create()){
        echo json_encode(
            array('message' => 'Quote Created')
        );
    }
    else {
        echo json_encode(
            array('message' => 'Quote Not Created')
        );
    }
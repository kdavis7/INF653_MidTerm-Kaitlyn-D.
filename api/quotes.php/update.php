<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
     Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/quotes.php';

    $database = new database();
    $db = $database->connect();

    $quote = new quotes($db);

    $data = json_decode(file_get_contents("php://input"));

    $quote->id = $data->id;

    $quote->quote = $data->quote;
    $quote->categoryId = $data->categoryId;
    $quote->authorId = $data->authorId;

    if($quote->update()){
        echo json_encode(
            array('message' => 'Quote Updated')
        );
    }
    else {
        echo json_encode(
            array('message' => 'Quote Not Updated')
        );
    }
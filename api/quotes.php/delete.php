<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
     Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/quotes.php';

    $database = new database();
    $db = $database->connect();

    $quote = new quotes($db);

    $data = json_decode(file_get_contents("php://input"));

    $quote->id = $data->id;

    if($quote->update()){
        echo json_encode(
            array('message' => 'Quote Deleted')
        );
    }
    else {
        echo json_encode(
            array('message' => 'Quote Not Deleted')
        );
    }
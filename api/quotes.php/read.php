<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/quotes.php';

    $database = new database();
    $db = $database->connect();

    $quote = new quotes($db);

    $result = $quote->read();

    $num = $result->rowCount();

    if($num > 0){
        $quotes_arr = array();
        $quotes_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => $quote,
                'categoryId' => $categoryId,
                'authorId' => $authorId,
            );
            array_push($quotes_arr['data'], $quote_item);
        }

        echo json_encode($quotes_arr);
        
    }
    else{
        echo json_encode(
            array('message' => 'No posts found')
        );
    }
<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/quotes.php';

    $database = new database();
    $db = $database->connect();

    $quote = new quotes($db);

    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    $quote->read_single();

    $quote_arr = array(
        'id' => $quote->id,
        'categoryId' => $quote->categoryId,
        'authorId' => $quote->authorId,
        'quote' => $quote->quote
    );

    print_r(json_encode($quote_arr));
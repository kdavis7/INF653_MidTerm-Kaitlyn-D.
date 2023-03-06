<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/authors.php';

    $database = new database();
    $db = $database->connect();

    $author = new authors($db);

    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    $author->read_single();

    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author,
    );

    print_r(json_encode($author_arr));
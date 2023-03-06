<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
     Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/authors.php';

    $database = new database();
    $db = $database->connect();

    $author = new authors($db);

    $data = json_decode(file_get_contents("php://input"));

    $author->author = $data->author;
    

    if($author->create()){
        echo json_encode(
            array('message' => 'Author Created')
        );
    }
    else {
        echo json_encode(
            array('message' => 'Author Not Created')
        );
    }
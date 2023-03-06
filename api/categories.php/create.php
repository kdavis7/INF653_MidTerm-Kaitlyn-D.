<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
     Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/categories.php';

    $database = new database();
    $db = $database->connect();

    $category = new categories($db);

    $data = json_decode(file_get_contents("php://input"));

    $category->categories = $data->categories;
    

    if($category->create()){
        echo json_encode(
            array('message' => 'Category Created')
        );
    }
    else {
        echo json_encode(
            array('message' => 'Category Not Created')
        );
    }
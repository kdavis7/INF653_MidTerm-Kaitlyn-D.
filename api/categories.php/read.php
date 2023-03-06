<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/categories.php';

    $database = new database();
    $db = $database->connect();

    $category = new categories($db);

    $result = $category->read();

    $num = $result->rowCount();

    if($num > 0){
        $category_arr = array();
        $category_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $category_item = array(
                'id' => $id,
                'categories' => $categories
            );
            array_push($category_arr['data'], $category_item);
        }

        echo json_encode($category_arr);
        
    }
    else{
        echo json_encode(
            array('message' => 'No categories found')
        );
    }
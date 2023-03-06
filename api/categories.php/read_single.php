<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/database.php';
    include_once '../../models/categories.php';

    $database = new database();
    $db = $database->connect();

    $category = new categories($db);

    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    $category->read_single();

    $category_arr = array(
        'id' => $category->id,
        'categories' => $category->categories,
    );

    print_r(json_encode($category_arr));
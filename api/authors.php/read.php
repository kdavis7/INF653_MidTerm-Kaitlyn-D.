<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/authors.php';

    $database = new database();
    $db = $database->connect();

    $author = new authors($db);

    $result = $author->read();

    $num = $result->rowCount();

    if($num > 0){
        $author_arr = array();
        $author_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $author_item = array(
                'id' => $id,
                'author' => $author
            );
            array_push($author_arr['data'], $author_item);
        }

        echo json_encode($author_arr);
        
    }
    else{
        echo json_encode(
            array('message' => 'No authors found')
        );
    }
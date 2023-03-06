<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    }
    if ($method === 'PUT'){
      require('update.php');
    }
    if ($method === 'GET' && isset($_GET['id'])){
      require('read_single.php');
      die();
    }
    if ($method === 'GET'){
      require('read.php');
    }
    if ($method === 'DELETE'){
      require('delete.php');
    }
    if ($method === 'POST'){
      require('create.php');
    }
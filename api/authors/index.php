<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
};

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if (isset($_GET['id'])){
        include_once('read_single.php');
    }else{
        include_once('read.php');
    }
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    include_once('create.php');
}else if($_SERVER['REQUEST_METHOD'] == "PUT"){
    include_once('update.php');
}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){
    include_once('delete.php');
};


    
?>
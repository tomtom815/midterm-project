<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate category object
    $category = new Category($db);

    //Get ID
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get Category
    $category->read_single();

    //Create array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    //Make JSON
    if($category->category != null){
        print_r(json_encode($category_arr));
    }else{
        //No quotes
        echo 'categoryId Not Found';
    }
?>
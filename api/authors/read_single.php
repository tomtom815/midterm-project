<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate author object
    $author = new Author($db);

    //Get ID
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get author
    $author->read_single();

    //Create array
    $author_arr = array(
        'id' => intval($author->id),
        'author' => $author->author
    );

   //Make JSON
    if($author->author != null){
    print_r(json_encode($author_arr));
    }else{
    //No quotes
    $err_arr = array('message' => 'authorId Not Found');
    print_r(json_encode($err_arr));
}
?>
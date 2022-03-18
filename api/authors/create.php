<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Author.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate Author object
$author = new Author($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$author->author = $data->author;



//Create Author
if($author->create()){
    //Create array
    $author_arr = array(
        'id' => intval($author->id),
        'author' => $author->author
    );
    print_r(json_encode($author_arr));
}else{
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}




?>
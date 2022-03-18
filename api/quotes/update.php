<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate Quote object
$quote = new Quote($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set ID to quote
$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->categoryId = $data->categoryId;
$quote->authorId = $data->authorId;


//Update quote
if($quote->update()){
    echo json_encode(
        array('message' => 'Quote Updated')
    );
}else{
    echo json_encode(
        array('message' => 'Quote Not Updated')
    );
}

?>
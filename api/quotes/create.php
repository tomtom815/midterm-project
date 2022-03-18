<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

$quote->quote = $data->quote;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;



//Create Quote
if($quote->create()){
    
    $quote_arr = array(
        'id' => intval($quote->conn->lastInsertId();),
        'categoryId' => $quote->categoryId,
        'authorId' => $quote->authorId,
        'quote' => $quote->quote
        
    );
    print_r(json_encode($quote_arr));
}else{
    echo json_encode(
        array('message' => 'Quote Not Created')
    );
}




?>
<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate blog quote object
    $quote = new Quote($db);

    //BLog quote query
    $result = $quote->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any quotes
    if($num > 0){
        //Quote array
        $quotes_arr = array();
        

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $quote_item = array(
                'id' => $id,
                'category' => $category,
                'author' => $author,
                'quote' => $quote
            );
            // Push to "data"
            array_push($quotes_arr, $quote_item);
        }
        //Turn to JSON & output
        echo json_encode($quotes_arr);

    }else{
        //No quotes
        echo json_encode(array('message' => 'No Quotes Found'));
    }
?>
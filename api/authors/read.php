<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: appliauthion/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

     //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate author object
    $author = new author($db);
     //author read query
    $result = $author->read();

    // Get row count
    $num = $result->rowCount();

    // Check if any authors
    if($num > 0){
        //Post array
        $auth_arr = array();
        

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $auth_item = array(
                'id' => intval($id),
                'author' => $author
            );
            // Push to array
            array_push($auth_arr, $auth_item);
        }
        //Turn to JSON & output
        echo json_encode($auth_arr);

    }else{
        //No authors
        echo json_encode(array('message' => 'No author Found'));
    }


?>
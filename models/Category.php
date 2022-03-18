<?php
    class Category{
//DB Stuff
private $conn;
private $table = 'categories';

//Properties
public $id;
public $category;


//Constuctor with DB
public function __construct($db){
    $this->conn = $db;
}

//Get catgories
public function read(){
    //create query
    $query = "SELECT 
    id,
    category
    FROM " . $this->table. "
    ORDER BY
    id DESC";

    //Prepare Statement
    $stmt = $this->conn->prepare($query);

    //Execute query
    $stmt->execute();

    return $stmt;
}

//Get single Category
public function read_single(){
   // Create query
    $query = 'SELECT
    id,
    category
    FROM
    ' . $this->table . ' 
    WHERE
    id = ?
    LIMIT 0,1';

//Prepare Statement
$stmt = $this->conn->prepare($query);
// Bind ID
$stmt->bindParam(1, $this->id);

//Execute query
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

//Set properties
$this->id = $row['id'];
$this->category = $row['category'];
}

//Create a category
public function create(){
    //Create query
    $query = 'INSERT INTO ' . $this->table . '
    SET
        category = :category ';
    //Prepare statement
    $stmt = $this->conn->prepare($query);

    //Clean data
    $this->category = htmlspecialchars(strip_tags($this->category));
    
    //Bind data
    $stmt->bindParam(':category', $this->category);

    //Execute query
    if($stmt->execute()){
        $this->id =  $this->conn->lastInsertId();
        return true;
    }

    //Print error if something goes wrong
    printf("Error: %s. \n", $stmt->error);
    return false;
}
//Update category
public function update(){
    //Create query
    $query = 'UPDATE ' . $this->table . '
    SET 
        category = :category
    WHERE
        id = :id ';
    //Prepare Statement
    $stmt = $this->conn->prepare($query);

    //Clean data
    $this->category = htmlspecialchars(strip_tags($this->category));
    $this->id = htmlspecialchars(strip_tags($this->id));

    //Bind data
    $stmt->bindParam(':category', $this->category);
    $stmt->bindParam(':id', $this->id);
    

    //Execute query
    if($stmt->execute()){
        return true;
    }
    //Print error if something goes wrong
    printf("Error: %s. \n", $stmt->error);

    return false;

}
//Delete Category
public function delete(){
    //Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    //Prepare Statement
    $stmt = $this->conn->prepare($query);

    //Clean Data
    $this->id = htmlspecialchars(strip_tags($this->id));

    //Bind Data
    $stmt->bindParam(':id', $this->id);

    //Execute query
    if($stmt->execute()){
        return true;
    }

    //Print error if something goes wrong
    printf("Error: %s. \n", $stmt->error);
    return false;
}
}
?>
<?php
    Class Quote{
        //DB Stuff
        private $conn;
        private $table = 'quotes';

        //Post properties
        public $id;
        public $categoryId;
        public $authorId;
        public $quote;
        

        //Constuctor with DB
        public function __construct($db){
            $this->conn = $db;
        }
        //Get Posts
        public function read(){
            // Create query
            $query = 'SELECT
                c.category as category,
                a.author as author,
                q.quote,
                q.id
                FROM
                ' . $this->table . ' q
                LEFT JOIN
                    categories c ON q.categoryId = c.id
                LEFT JOIN
                    authors a ON q.authorId = a.id
                ORDER BY
                    q.id DESC';
            $queryAuthorId = 'SELECT
                c.category as category,
                a.author as author,
                q.quote,
                q.id
                FROM
                ' . $this->table . ' q
                LEFT JOIN
                    categories c ON q.categoryId = c.id
                LEFT JOIN
                    authors a ON q.authorId = a.id
                WHERE
                    q.authorId = :authorId
                ORDER BY
                    q.id DESC';
            $queryCategoryId = 'SELECT
                c.category as category,
                a.author as author,
                q.quote,
                q.id
                FROM
                ' . $this->table . ' q
                LEFT JOIN
                    categories c ON q.categoryId = c.id
                LEFT JOIN
                    authors a ON q.authorId = a.id
                WHERE
                    q.categoryId = :categoryId
                ORDER BY
                    q.id DESC';
            $queryBothId = 'SELECT
                c.category as category,
                a.author as author,
                q.quote,
                q.id
                FROM
                ' . $this->table . ' q
                LEFT JOIN
                    categories c ON q.categoryId = c.id
                LEFT JOIN
                    authors a ON q.authorId = a.id
                WHERE
                    q.authorId = :authorId AND q.categoryId = :categoryId
                ORDER BY
                    q.id DESC';
                // Prepare Statement based on request
                if(isset($_GET['authorId']) && isset($_GET['categoryId'])){
                    $stmt = $this->conn->prepare($queryBothId);
                    $stmt->bindParam(':authorId', $_GET['authorId']);
                    $stmt->bindParam(':categoryId', $_GET['categoryId']);
                }else if(isset($_GET['categoryId'])){
                    $stmt = $this->conn->prepare($queryCategoryId);
                    $stmt->bindParam(':categoryId', $_GET['categoryId']);
                }else if(isset($_GET['authorId'])){
                    $stmt = $this->conn->prepare($queryAuthorId);
                    $stmt->bindParam(':authorId', $_GET['authorId']);
                }else{
                    $stmt = $this->conn->prepare($query);
                }
                

                // Execute query
                $stmt->execute();

                return $stmt;         
        }

        // Get single Post
        public function read_single(){
            // Create query
            $query = 'SELECT
                c.category as category,
                a.author as author,
                q.quote,
                q.id
                FROM
                ' . $this->table . ' q
                LEFT JOIN
                    categories c ON q.categoryId = c.id
                LEFT JOIN
                    authors a ON q.authorId = a.id
                WHERE
                    q.id = ?
                LIMIT 0,1';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(1, $this->id);

            //Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->category = $row['category'];
            $this->author = $row['author'];
            $this->quote = $row['quote'];
            $this->id = $row['id'];
            
            
            
        }

        //Create post
        public function create(){
            //Create query
            $query = 'INSERT INTO ' . $this->table . '
            SET 
                quote = :quote,
                authorId = :authorId,
                categoryId = :categoryId
            ';
            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->authorId = htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

            //Bind data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);

            //Execute query
            if($stmt->execute()){
                $this->id =  $this->conn->lastInsertId();
                return true;
            }
            //Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);

            return false;

        }

        //Update post
        public function update(){
            //Create query
            $query = 'UPDATE ' . $this->table . '
            SET 
                quote = :quote,
                authorId = :authorId,
                categoryId = :categoryId
            WHERE
                id = :id
            ';
            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->authorId = htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);
            $stmt->bindParam(':id', $this->id);
            

            //Execute query
            if($stmt->execute()){
                return true;
            }
            //Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);

            return false;

        }
        //Delete Post
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
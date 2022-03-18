<?php
    class Database{
        // DB Params

        private $conn;


        // DB connect
        public function connect(){
            
            $url = getenv('JAWSDB_URL');
            $dbparts = parse_url($url);
        
            $hostname = getenv("HOST");
            $username = getenv("USER");
            $password = getenv("PASS");
            $database = getenv("DB");
        
            // Create your new PDO connection here
            // This is also from the Heroku docs showing the PDO connection: 
            try {
            $this->conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
              // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            }
            catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
    
        }
    }
?>

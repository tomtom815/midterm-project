<?php
    class Database{
        // DB Params
        
        private $hostname = 'x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        private $username = 'vys4c4kcbifex17h';
        private $password = getenv("PASS");
        private $database = 'jqllxwqtcfrc3a98';
        private $conn;


        // DB connect
        public function connect() {
            // Create your new PDO connection here
            // This is also from the Heroku docs showing the PDO connection: 
            try {
                $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
              // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully";
            }
            catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
            }
            // We used this PDO connection format in previous weeks - reference w3schools.com
        }
    }
?>

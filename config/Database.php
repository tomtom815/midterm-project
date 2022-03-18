<?php
    class Database{
        // DB Params
        
        private $hostname;
        private $username;
        private $password
        private $database;
        private $conn;


        // DB connect
        public function connect() {
            // if creating a Heroku connection, this is straight from the dev center link: 
        
        
            $this->hostname = 'x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
            $this->username = 'vys4c4kcbifex17h';
            $this->password = getenv("PASS");
            $this->database = 'jqllxwqtcfrc3a98';
            //You cannot do the above for your local dev environment, just Heroku
        
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
            // We used this PDO connection format in previous weeks - reference w3schools.com
        }
    }
?>

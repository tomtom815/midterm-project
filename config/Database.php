<?php
    class Database{
        // DB Params
        
        private $conn;


        // DB connect
        public function connect() {
            $hostname = 'x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
            $username = 'vys4c4kcbifex17h';
            $password = 'seye1av40qv361an';
            $database = 'jqllxwqtcfrc3a98';
            // Create your new PDO connection here
            // This is also from the Heroku docs showing the PDO connection: 
            try {
                $this->conn = new PDO("mysql://vys4c4kcbifex17h:seye1av40qv361an@x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/jqllxwqtcfrc3a98");
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

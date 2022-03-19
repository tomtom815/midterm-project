<?php
    class Database{
        // DB Params
        /*private $url = getenv('JAWSDB_URL');
        private $dbparts = parse_url($url);*/

        private $hostname = "x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        private $username = "vys4c4kcbifex17h";
        private $password = "tbtixrj0pak8ol19";
        private $database = "jqllxwqtcfrc3a98";
        private $conn;

        public function connect(){
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
                // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                }
            catch(PDOException $e)
                {
                echo "Connection failed: " . $e->getMessage();
                }
            return $this->conn;

        }
    }

    
?>

<?php
    class Database{
        // DB Params
        private $host = "x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        private $db_name = "jqllxwqtcfrc3a98";
        private $username = "vys4c4kcbifex17h";
        private $password = "seye1av40qv361an";
        private $conn;


        // DB connect
        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host =' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;

        }
    }
?>

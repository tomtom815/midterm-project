<?php
    class Database{
        // DB Params
        
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);

        private $host = getenv('HOST');
        private $username = getenv('USER');
        private $password = getenv('PASS');
        private $db_name = getenv('DB');    
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

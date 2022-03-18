<?php
    class Database{
        // DB Params
        
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);

        private $host = $dbparts['host'];
        private $username = $dbparts['user'];
        private $password = $dbparts['pass'];
        private $db_name = ltrim($dbparts['path'],'/');    
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

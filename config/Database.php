<?php
    class Database{
        // DB Params
        private $url = getenv('JAWSDB_URL');
        private $dbparts = parse_url($url);

        private $hostname = $dbparts['host'];
        private $username = $dbparts['user'];
        private $password = $dbparts['pass'];
        private $database = ltrim($dbparts['path'],'/');
        private $conn;

        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;

        }
    }

    
?>

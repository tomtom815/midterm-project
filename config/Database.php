<?php
    class Database{
        // DB Params
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);

        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');
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

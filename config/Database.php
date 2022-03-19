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
            return $this->conn;

        }
    }

    
?>

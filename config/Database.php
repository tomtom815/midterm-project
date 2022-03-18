<?php
    class Database{
        // DB Params
        $url = getenv('mysql://vys4c4kcbifex17h:seye1av40qv361an@x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/jqllxwqtcfrc3a98

        ');
        $dbparts = parse_url($url);
    
        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');


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

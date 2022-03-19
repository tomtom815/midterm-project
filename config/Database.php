<?php
    class Database {
    // Define the class properties here
    // private $conn; for example 

    public function connect() {
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);
        
        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');
        $conn;

      // Create your new PDO connection here
      // This is also from the Heroku docs showing the PDO connection: 
        // Create connection
        $this->conn = new mysqli($hostname, $username, $password, $database);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connection was successfully established!";
    
?>

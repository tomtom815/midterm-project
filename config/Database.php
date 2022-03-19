<?php
    class Database {
    // Define the class properties here
    // private $conn; for example 

    public function connect() {
      // if creating a Heroku connection, this is straight from the dev center link: 
        /*$url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);

        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'],'/');*/

      // Create your new PDO connection here
      // This is also from the Heroku docs showing the PDO connection: 
        try {
        $conn = new PDO("mysql://vys4c4kcbifex17h:seye1av40qv361an@x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/jqllxwqtcfrc3a98");
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

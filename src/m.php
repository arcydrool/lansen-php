<?php
class Model {

    private $conn;
    // Constructor
    public function __construct() {
        $this->conn = $this->connect();
    }

    static function connect() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        // Database credentials
        $jsonData = json_decode(file_get_contents('../src/db.json'),true);

        // Create a connection
        $conn = new mysqli($jsonData["host"], $jsonData["username"], $jsonData["password"], $jsonData["database"]);

        // Check the connection
        if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function add_contact($input){
        return "Got a contact: " . (empty($input["name"])? "empty": $input["name"]) . " ";
    }

}


?>
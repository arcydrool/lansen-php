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
        $conn = $this->conn;
        if(empty($input["name"]) 
            || empty($input["company"]) 
            || empty($input["email"]) 
            || empty($input["tel"]) ){
            throw new Exception("Not Enough Information for a Contact");
        }
        $sql = 'INSERT INTO contact (name, company, email, mail, tel, interests, additional) VALUES (?, ?, ?, ?, ?, ?, ?)';

            #post.name, post.company, post.email, post.tel, interests, post.additional);";
        
        $sth = $conn->prepare($sql);
        $sth->bind_param("sssssss", $p_name, $p_company, $p_email, $p_mail, $p_tel, $p_interests, $p_additional);
        $p_name = $input["name"];
        $p_company = $input["company"];
        $p_email = $input["email"];
        $p_tel = $input["tel"];
        $p_mail = empty($input["email"]) ? "" : $input["mail"];
        if(isset($input["interests"]) && is_array($input["interests"])){
            $p_interests = implode(', ', $input["interests"]);
        } else {
            $p_interests = "";
        }
        $p_additional = $input["additional"];
        if ($sth->execute()) {
            return array("id" => $conn->insert_id);
        }
        throw new Exception("Faiure adding contact") ;
    }

}


?>
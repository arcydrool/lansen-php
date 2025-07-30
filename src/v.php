<?php
class View {

    // Properties
    private $value;
    private $error;
    private $server_problem;

    public function __construct(){
        $this->server_problem = false;
    }

    public function get_input() {
        $input = json_decode(file_get_contents('php://input'), true);
        if(is_null($input)){
            $err = json_last_error_msg() || "Input Not Accepted";
            $this->set_error($err);
            new Exception($err);
        }  
        return $input;
    }

    public function set_server_problem($p){
        if($p){
            $this->server_problem = true;
        } else {
            $this->server_problem = false;
        }
    }

    // set the success value
    public function set_value($value) {
        $this->value = $value;
    }

    public function set_error($error){
        $this->error = $error;
    }

    //send a thoughtful response
    public function emit() {
        if($this->error){
            if($this->server_problem){
                http_response_code(500);
            } else {
                http_response_code(400);
            }
            header("Content-Type: application/json");
            echo json_encode(["message" => $this->error]);
        } else {
            http_response_code(200);
            header("Content-Type: application/json");
            if(isset($this->value)){
                echo json_encode($this->value);
            } else {
                echo json_encode(array());
            }
            
        }
    }
}


?>
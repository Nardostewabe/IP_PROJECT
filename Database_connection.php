<?php
class Database_connection{
    private $servername;
    private $username;
    private $password;
    private $database_name; 
    
    public function __construct() {
      $this->servername ="localhost";
      $this->username ="root";
      $this->password ="";
      $this->database_name ="Myuser"; 

    }

    public function connect(){
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->database_name);


        if($conn->connect_error){
            die("Connection failed due to..".$conn->error);
        }

        else{
            
                return $conn;
        }
    }
}
// $connect = new Database_connection();
// $conn = $connect->connect();
?>

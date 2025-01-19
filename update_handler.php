<?php
include_once 'Database_connection.php';
class update_handler {
 private $conn; 

 public function __construct(){
    $db = new Database_connetion();
    $this ->conn = db.connect();

public function handleUpdate(){
     if(isset($_POST['upadate'])){

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email']; 
        
        if($this->updateUser($id, $name, $email)){
            echo "Update successful";
        }
        else{
            echo "Error updating user data";
        }   
    }

    else{
        echo "Error in request.";
    }
 }

 private function updateUser($id, $name, $email){
    
    $holder = $conn ->preapare("UPDATE users name = ?, email = ?, WHERE id = ?");

    $holder->bind_param("ssi", $name, $email, $id);

    return $holder->execute();

 }
}



}

    
   


?>
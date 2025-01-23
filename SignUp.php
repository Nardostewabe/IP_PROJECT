<?php

include "Database_connection.php";

if($_SERVER['REQUEST_METHOD']=="POST"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

class SignUp extends Database_connection{

    public function Save_user_data($name,$email,$pass){
        $conn = $this->connect();
        
        $query = "INSERT INTO users( username,email,password1) VALUES ('$name','$email','$pass')";

        $result = $conn->query($query);

        if($result){
            header("location: log.html");
            exit();
        }

        else {
            die("isertion failed ");
        }
    }
}
}

$save =new SignUp();

$save->Save_user_data($name,$email,$pass);
?>

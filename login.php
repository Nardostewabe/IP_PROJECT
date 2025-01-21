<?php
include "Database_connection.php";

class login extends Database_connection{
public function Validate_data($name,$email,$pass){

    $conn = $this->connect();
    $query = "SELECT * FROM Users WHERE email = '$email' AND password1='$pass' AND username = '$name' ";
    $sql = "SELECT * FROM sellers WHERE email = '$email' AND password1='$pass' AND username = '$name' ";
    $result = $conn->query($query);
    $qry = $conn->query($sql);


    if($result->num_rows > 0){
        session_start();
        
        $_SESSION['usertype'] = "Customer";
        echo "<h2 align = 'center'>Log in succesful</h2>";
        $get = "SELECT * FROM users WHERE username = '$name'";
        $res = $conn->query($get);
        $uid = $res->fetch_array();
        echo "Your User Id is ";
        $_SESSION['UID']=$uid[0];
        $_SESSION['name']= $uid[1];
        echo $uid[0];
    }
    else{
        if($qry->num_rows > 0){
            session_start();
            
            $_SESSION['usertype'] = "Seller";
            echo "<h2 align = 'center' >Welcome Back</h2>";
            $get = "SELECT * FROM sellers WHERE username = '$name'";
            $res = $conn->query($get);
            $sid = $res->fetch_array();
            echo "Your Seller Id is ";
            $_SESSION['SID']=$sid[0];
            $_SESSION['name']= $sid[1];
            echo $sid[0];
        }
    }
}
}
if($_SERVER['REQUEST_METHOD']=="POST"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

$validate = new login();

$validate->Validate_data($name,$email,$pass);
}
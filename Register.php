<?php
include "Database_connection.php";
class seller extends Database_connection{
public function save_seller_data($name,$email,$pass){
    $conn = $this->connect();
    $query = "INSERT INTO sellers(username,email,password1) VALUES('$name','$email','$pass')";
    session_start();
    $uid = $_SESSION['UID'];
    $sql = "DELETE FROM users WHERE UID =$uid";

    $result = $conn->query($query);

    $delete = $conn->query($sql);

    if(!$result){
        echo "Sign Up failed,<a href='seller.php'>try again..</a>";
    }

    else{
        $conn->close();
        header("location:loginto.php");
        exit();
    }
}
}
if($_SERVER['REQUEST_METHOD']=="POST"){
    $name = $_POST['uname'];
    $email = $_POST['em'];
    $pass = $_POST['pswd'];

    $seller = new seller();

    $seller->save_seller_data($name,$email,$pass);
}


?>
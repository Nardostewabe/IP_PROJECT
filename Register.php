<?php
include "Database_connection.php";
class seller extends Database_connection{
public function save_seller_data($name,$email,$pass){
    $conn = $this->connect();
    $query = "INSERT INTO sellers(username,email,password1) VALUES('$name','$email','$pass')";

    $result = $conn->query($query);

    if(!$result){
        echo "Sign Up failed,<a href='seller.php'>try again..</a>";
    }

    else{
        header("location:login.html");
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
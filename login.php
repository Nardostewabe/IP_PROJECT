<?php
include "Database_connection.php";

class login extends Database_connection{
public function Validate_data($name,$email,$pass){

    session_start();
    $conn = $this->connect();
    $query = "SELECT * FROM Users WHERE email = '$email' AND password1='$pass' AND username = '$name' ";
    $sql = "SELECT * FROM sellers WHERE email = '$email' AND password1='$pass' AND username = '$name' ";
    $result = $conn->query($query);
    $qry = $conn->query($sql);
    

    if($result->num_rows > 0){
        
        
        $_SESSION['usertype'] = "Customer";
        echo "<script>alert('Logged In Succesfully.'); window.location.href = 'LogInView.php';</script>";
        $get = "SELECT * FROM users WHERE username = '$name'";
        $res = $conn->query($get);
        $uid = $res->fetch_array();
        $_SESSION['UID']=$uid[0];
        $_SESSION['name']= $uid[1];
        echo $uid[0];
        echo "<script type='text/javascript'>onclick='window.location.reload(true);'</script>";
        
    }
    else{
        if($qry->num_rows > 0){
            
            $_SESSION['usertype'] = "Seller";
            echo "<script>alert('Logged In Succesfully.'); window.location.href = 'LogInView.php';</script>";
            $get = "SELECT * FROM sellers WHERE username = '$name'";
            $res = $conn->query($get);
            $sid = $res->fetch_array();
            $_SESSION['SID']=$sid[0];
            $_SESSION['name']= $sid[1];
            echo "<script type='text/javascript'>onclick='window.location.reload(true);'</script>";
            
        }
        else{
            echo "<h2><strong>Log in failed. Incorrect Username or Password or Email. ";
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

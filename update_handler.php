<?php
include_once 'Database_connection.php'

if(isset($_POST['upadate'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $db = new Database_connection();
    $conn = $db ->connect();

    $holder = $conn ->preapare("UPDATE users name = ?, email = ?, WHERE id = ?");

    $holder->bind_param("ssi", $name, $email, $id);

    if($holder->execute()){
        echo "User data updated successfully.";
    }

    else{
        echo "Error updating user data.";
    }

}
?>
<?php
require_once 'Database_connection.php';

class SellerModel extends Database_connection {

    public function saveSellerData($name, $email, $pass) {
        $conn = $this->connect();

        
        $query = "INSERT INTO sellers(username, email, password1) VALUES('$name', '$email', '$pass')";
        
        
        session_start();
        $uid = $_SESSION['UID'];

       
        $deleteQuery = "DELETE FROM users WHERE UID = $uid";

        
        $result = $conn->query($query);
        $delete = $conn->query($deleteQuery);

        
        return $result && $delete;
    }
}
?>

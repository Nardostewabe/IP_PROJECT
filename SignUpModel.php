<?php
require_once "Database_connection.php";

class SignUpModel extends Database_connection {
    public function saveUser($name, $email, $pass) {
        $conn = $this->connect();
        $query = "INSERT INTO users (username, email, password1) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $pass);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>

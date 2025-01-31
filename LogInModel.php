<?php
require_once "Database_connection.php";

class LoginModel extends Database_connection {
    public function validateUser($name, $email, $pass) {
        $conn = $this->connect();
        $query = "SELECT * FROM Users WHERE email = ? AND password1 = ? AND username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $email, $pass, $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function validateSeller($name, $email, $pass) {
        $conn = $this->connect();
        $query = "SELECT * FROM sellers WHERE email = ? AND password1 = ? AND username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $email, $pass, $name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>

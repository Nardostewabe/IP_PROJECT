<?php
session_start();
require_once "Database_connection.php"; 
class AccountDeletion {
    private $conn;
    private $userId;
    private $userType;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
        
        if (!isset($_SESSION['UID']) && !isset($_SESSION['SID'])) {
            header("Location: loginto.php");
            exit();
        }

        $this->userType = $_SESSION['usertype'];
        $this->userId = ($this->userType == "Seller") ? $_SESSION['SID'] : $_SESSION['UID'];
    }

    public function deleteAccount() {
        $table = ($this->userType == "Seller") ? "sellers" : "users";
        $column = ($this->userType == "Seller") ? "sid" : "UID";

        if (!$this->deleteOrders($column)) {
            $this->showAlertAndRedirect("Failed to delete related orders.");
            return;
        }

        $deleteUserQuery = "DELETE FROM $table WHERE $column = ?";
        $stmtUser = $this->conn->prepare($deleteUserQuery);

        if (!$stmtUser) {
            $this->showAlertAndRedirect("Failed to prepare statement. Please try again.");
            return;
        }

        $stmtUser->bind_param("i", $this->userId);

        if ($stmtUser->execute()) {
            $this->logout();
        } else {
            $this->showAlertAndRedirect("Failed to delete account. Please try again.");
        }

        $stmtUser->close();
    }

    private function deleteOrders($column) {
        $deleteOrdersQuery = "DELETE FROM orders WHERE $column = ?";
        $stmtOrders = $this->conn->prepare($deleteOrdersQuery);
        $stmtOrders->bind_param("i", $this->userId);
        $result = $stmtOrders->execute();
        $stmtOrders->close();
        return $result;
    }

    private function logout() {
        session_unset();
        session_destroy();
        $this->showAlertAndRedirect("Account deleted successfully!", "loginto.php");
    }

    private function showAlertAndRedirect($message, $redirect = "javascript:window.history.back();") {
        echo "<script>alert('$message'); window.location.href = '$redirect';</script>";
    }
}


$database = new Database_connection();
$conn = $database->connect();

$accountDeletion = new AccountDeletion($conn);
$accountDeletion->deleteAccount();

?>

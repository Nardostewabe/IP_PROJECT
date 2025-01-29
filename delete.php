<?php
session_start();
require_once "Database_connection.php"; 

class AccountDeletion {
    private $conn;
    private $userId;
    private $userType;
    private $sellerId;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;

        if (!isset($_SESSION['UID']) && !isset($_SESSION['SID'])) {
            header("Location: loginto.php");
            exit();
        }

        $this->userType = $_SESSION['usertype'];
        $this->userId = isset($_SESSION['UID']) ? $_SESSION['UID'] : null;
        $this->sellerId = isset($_SESSION['SID']) ? $_SESSION['SID'] : null;

        if ($this->userType == "Seller" && !$this->sellerId) {
            $this->showAlertAndRedirect("Invalid seller account.");
            exit();
        }
    }

    public function deleteAccount() {
        if ($this->userType == "Seller") {
            $this->deleteSellerData();
        } elseif($this->userType == "Customer") {
            $this->deleteCustomerData();
        }
        else{
            $this->showAlertAndRedirect("Invalid Users");
        }
        $this->logout();
    }

    private function deleteSellerData() {
        
        if (!$this->deleteRelatedRecords("orders", "sid", $this->sellerId)) {
            $this->showAlertAndRedirect("Failed to delete orders.");
            return;
        }

        
        if (!$this->deleteRelatedRecords("products", "sid", $this->sellerId)) {
            $this->showAlertAndRedirect("Failed to delete products.");
            return;
        }

        
        if (!$this->deleteRelatedRecords("patterns", "sid", $this->sellerId)) {
            $this->showAlertAndRedirect("Failed to delete patterns.");
            return;
        }

        
        if (!$this->deleteUser("sellers", "sid", $this->sellerId)) {
            $this->showAlertAndRedirect("Failed to delete seller account.");
            return;
        }
    }

    private function deleteCustomerData() {
        
        if (!$this->deleteRelatedRecords("orders", "UID", $this->userId)) {
            $this->showAlertAndRedirect("Failed to delete orders.");
            return;
        }

        
        if (!$this->deleteUser("users", "UID", $this->userId)) {
            $this->showAlertAndRedirect("Failed to delete customer account.");
            return;
        }
    }

    private function deleteRelatedRecords($table, $column, $id) {
        $query = "DELETE FROM $table WHERE $column = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    private function deleteUser($table, $column, $id) {
        $query = "DELETE FROM $table WHERE $column = ?";
        $stmt = $this->conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
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

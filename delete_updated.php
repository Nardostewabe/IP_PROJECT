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

        // Check if the seller has products or active orders
        if ($this->userType == "Seller") {
            if (!$this->hasNoActiveProducts()) {
                $this->showAlertAndRedirect("You must delete all your products before deleting your account.");
                return;
            }

            if (!$this->hasNoActiveOrders()) {
                $this->showAlertAndRedirect("You must clear all orders before deleting your account.");
                return;
            }
        }

        // Delete related orders
        if (!$this->deleteOrders($column)) {
            $this->showAlertAndRedirect("Failed to delete related orders.");
            return;
        }

        // Delete the user's data from the database
        $deleteUserQuery = "DELETE FROM $table WHERE $column = ?";
        $stmtUser = $this->conn->prepare($deleteUserQuery);

        if (!$stmtUser) {
            $this->showAlertAndRedirect("Failed to prepare statement. Please try again.");
            return;
        }

        $stmtUser->bind_param("i", $this->userId);

        if ($stmtUser->execute()) {
            // Delete seller’s products (if they are a seller)
            if ($this->userType == "Seller") {
                $this->deleteSellerProducts();
            }
            // Log out the user
            $this->logout();
        } else {
            $this->showAlertAndRedirect("Failed to delete account. Please try again.");
        }

        $stmtUser->close();
    }

    private function hasNoActiveProducts() {
        $checkProductsQuery = "SELECT COUNT(*) FROM products WHERE seller_id = ?"; // Assuming 'seller_id' is the column that links products to sellers
        $stmt = $this->conn->prepare($checkProductsQuery);
        $stmt->bind_param("i", $this->userId);
        $stmt->execute();
        $stmt->bind_result($productCount);
        $stmt->fetch();
        $stmt->close();

        return $productCount == 0; // No active products
    }

    private function hasNoActiveOrders() {
        $checkOrdersQuery = "SELECT COUNT(*) FROM orders WHERE seller_id = ?"; // Assuming 'seller_id' is the column that links orders to sellers
        $stmt = $this->conn->prepare($checkOrdersQuery);
        $stmt->bind_param("i", $this->userId);
        $stmt->execute();
        $stmt->bind_result($orderCount);
        $stmt->fetch();
        $stmt->close();

        return $orderCount == 0; // No active orders
    }

    private function deleteOrders($column) {
        $deleteOrdersQuery = "DELETE FROM orders WHERE $column = ?";
        $stmtOrders = $this->conn->prepare($deleteOrdersQuery);
        $stmtOrders->bind_param("i", $this->userId);
        $result = $stmtOrders->execute();
        $stmtOrders->close();
        return $result;
    }

    private function deleteSellerProducts() {
        $deleteProductsQuery = "DELETE FROM products WHERE seller_id = ?";
        $stmtProducts = $this->conn->prepare($deleteProductsQuery);
        $stmtProducts->bind_param("i", $this->userId);
        $stmtProducts->execute();
        $stmtProducts->close();
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

// Create a new instance of the database connection
$database = new Database_connection();
$conn = $database->connect();

// Create a new instance of the AccountDeletion class
$accountDeletion = new AccountDeletion($conn);

// Attempt to delete the account
$accountDeletion->deleteAccount();

?>

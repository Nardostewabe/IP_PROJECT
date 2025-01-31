<?php
require_once "AccountModel.php";
session_start();

class AccountController {
    private $accountModel;
    private $userId;
    private $sellerId;
    private $userType;

    public function __construct() {
        $this->accountModel = new AccountModel();

        if (!isset($_SESSION['UID']) && !isset($_SESSION['SID'])) {
            $this->redirect("SignUpView.php");
        }

        $this->userType = $_SESSION['usertype'];
        $this->userId = $_SESSION['UID'] ?? null;
        $this->sellerId = $_SESSION['SID'] ?? null;
    }

    public function deleteAccount() {
        if ($this->userType == "Seller") {
            $this->deleteSellerData();
        } elseif ($this->userType == "Customer") {
            $this->deleteCustomerData();
        } else {
            $this->alert("Invalid user type.");
        }

        $this->logout();
    }

    private function deleteSellerData() {
        $tables = ["orders", "products", "patterns", "sellers"];
        foreach ($tables as $table) {
            if (!$this->accountModel->deleteRecords($table, "sid", $this->sellerId)) {
                $this->alert("Failed to delete records from $table.");
                return;
            }
        }
    }

    private function deleteCustomerData() {
        if (!$this->accountModel->deleteRecords("orders", "UID", $this->userId) ||
            !$this->accountModel->deleteRecords("users", "UID", $this->userId)) {
            $this->alert("Failed to delete user account.");
            return;
        }
    }

    private function logout() {
        session_unset();
        session_destroy();
        $this->alert("Account deleted successfully!", "SignUpView.php");
    }

    private function alert($message, $redirect = "javascript:window.history.back();") {
        echo "<script>alert('$message'); window.location.href = '$redirect';</script>";
    }

    private function redirect($url) {
        header("Location: $url");
        exit();
    }
}

$controller = new AccountController();
$controller->deleteAccount();
?>

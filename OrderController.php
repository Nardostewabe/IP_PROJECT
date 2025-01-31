<?php
require_once "OrderModel.php";
session_start();

class OrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    public function cancelOrder($orderId) {
        if (!isset($_SESSION['UID'])) {
            header("Location: SignUpView.php");
            exit();
        }

        $uid = $_SESSION['UID'];
        $success = $this->orderModel->cancelOrder($orderId, $uid);

        if ($success) {
            echo "<script>alert('Order canceled successfully!'); window.location.href = 'Vieworders.php';</script>";
        } else {
            echo "<script>alert('Failed to cancel order. Please try again.'); window.history.back();</script>";
        }
    }
}

if (isset($_GET['order_id'])) {
    $controller = new OrderController();
    $controller->cancelOrder($_GET['order_id']);
} else {
    echo "<script>alert('Invalid order ID.'); window.history.back();</script>";
}
?>

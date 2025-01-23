<?php
require_once "Database_connection.php";
session_start();

class CancelOrder {
    private $conn;
    private $uid;

    public function __construct($conn, $uid) {
        $this->conn = $conn;
        $this->uid = $uid;
    }

    public function cancel($orderId) {
        $query = "DELETE FROM orders WHERE OID = ? AND UID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $orderId, $this->uid);

        if ($stmt->execute()) {
            echo "<script>alert('Order canceled successfully!'); window.location.href = 'Vieworders.php';</script>";
        } else {
            echo "<script>alert('Failed to cancel order. Please try again.'); window.history.back();</script>";
        }

        $stmt->close();
    }
}

if (!isset($_SESSION['UID'])) {
    header("Location: loginto.php");
    exit();
}

if (isset($_GET['order_id'])) {
    $db = new Database_connection();
    $conn = $db->connect();
    $cancelOrder = new CancelOrder($conn, $_SESSION['UID']);
    $cancelOrder->cancel($_GET['order_id']);
    $conn->close();
} else {
    echo "<script>alert('Invalid order ID.'); window.history.back();</script>";
}
?>

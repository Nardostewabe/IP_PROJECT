<?php
require_once "Database_connection.php";

class OrderModel extends Database_connection {
    public function cancelOrder($orderId, $uid) {
        $conn = $this->connect();
        $query = "DELETE FROM orders WHERE OID = ? AND UID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $orderId, $uid);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }
}
?>

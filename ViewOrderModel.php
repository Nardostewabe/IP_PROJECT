<?php
require_once "Database_connection.php";

class ViewOrderModel extends Database_connection {
    public function fetchOrders($uid, $user_role) {
        $conn = $this->connect(); 

        if ($user_role == 'Customer') {
            $query = "SELECT OID, order_name, order_price, order_date FROM orders WHERE UID = ?";
        } elseif ($user_role == 'Seller') {
            $query = "SELECT OID, UID, order_name, order_price, order_date FROM orders WHERE sid = ?";
        } else {
            echo "Invalid role.";
            return [];
        }

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $result = $stmt->get_result();

        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }

        return $orders;
    }
}
?>

<?php
require_once "Database_connection.php";

class PurchaseModel extends Database_connection {
    private $name;
    private $price;
    private $uid;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
        $this->uid = $_SESSION['UID'];
    }

    public function addOrder() {
        $conn = $this->connect();
        $sid = $this->getSidFromReferrer($conn);

        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO orders (UID, sid, order_name, order_price, order_date) 
                  VALUES ($this->uid, $sid, '$this->name', '$this->price', '$date')";

        $result = $conn->query($query);
        return $result;
    }

    private function getSidFromReferrer($conn) {
        $referrer = $_SERVER['HTTP_REFERER'];
        $sid = 1;  // Default value

        if (strpos($referrer, 'products.php') !== false) {
            $getter = "SELECT sid FROM products WHERE product_name = '$this->name'";
            $get = $conn->query($getter);
            if ($get && $r = $get->fetch_assoc()) {
                $sid = $r['sid'];
            }
        } elseif (strpos($referrer, 'patterns.php') !== false) {
            $getter = "SELECT sid FROM patterns WHERE pat_name = '$this->name'";
            $get = $conn->query($getter);
            if ($get && $r = $get->fetch_assoc()) {
                $sid = $r['sid'];
            }
        }
        return $sid;
    }
}
?>

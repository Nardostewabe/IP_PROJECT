<?php
require_once "Database_connection.php";
session_start();

class purchase extends Database_connection {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function add_to_my_orders() {
        $connect = new Database_connection();
        $conn = $connect->connect();

        $uid = $_SESSION['UID'];
        $date = date('Y-m-d H:i:s');

        $referrer = $_SERVER['HTTP_REFERER'];


        $sid = 1; 

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


        $query = "INSERT INTO orders (UID, sid, order_name, order_price, order_date) 
                  VALUES ($uid, $sid, '$this->name', '$this->price', '$date')";

        $result = $conn->query($query);

        if ($result) {
            header("location:Vieworders.php");
            exit();
        } else {
            die("Failed to purchase: " . $conn->error);
        }
    }
}

if (!isset($_SESSION['UID'])) {
    header("location:loginto.php");
    exit();
} elseif (isset($_GET['name']) && isset($_GET['price'])) {
    $purchased = new purchase($_GET['name'], $_GET['price']);
    $purchased->add_to_my_orders();
} else {
    echo "Product does not exist";
}
?>

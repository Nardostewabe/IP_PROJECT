<?php
require_once "Database_connection.php";

class products extends Database_connection {
    private $name;
    private $price;
    private $cat_id;

    public function __construct($name, $price, $cat_id) {
        $this->name = $name;
        $this->price = $price;
        $this->cat_id = $cat_id;
    }

    public function add_product() {
        session_start();

        $conn = $this->connect();

        // Escape inputs to avoid SQL injection
        $name = $conn->real_escape_string($this->name);
        $price = (float) $this->price;
        $cat_id = (int) $this->cat_id;
        $pic_url = $conn->real_escape_string($_FILES['picture']['name']);
        $sid = isset($_SESSION['SID']) ? $_SESSION['SID'] : 0;

        $query = "INSERT INTO products (product_name, price, image_url, cat_id, sid) 
                  VALUES ('$name', $price, '$pic_url', $cat_id, $sid)";

        if ($conn->query($query)) {
            // Move the file
            $upload = "images/";
            $target_file = $upload . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $target_file);

            // Redirect after successful insert
            header("location: categories.php");
            exit();  // Make sure to stop script execution
        } else {
            echo "<div class='alert' style='background-color: pink'>Failed to Add Product</div>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['pdname'];
    $price = $_POST['pdprice'];
    $cat_id = $_POST['category_id'];

    $product = new products($name, $price, $cat_id);
    $product->add_product();
}
?>

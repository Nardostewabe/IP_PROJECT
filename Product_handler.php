<?php
require_once "Database_connection.php";
require_once "Checker.php";

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

        $name = $conn->real_escape_string($this->name);
        $price = (float) $this->price;
        $cat_id = (int) $this->cat_id;
        $pic_url = $conn->real_escape_string($_FILES['picture']['name']);
        $sid = $_SESSION['SID'];

        $query = "INSERT INTO products (product_name, price, image_url, cat_id, sid) 
                  VALUES ('$name', $price, '$pic_url', $cat_id, $sid)";

        if ($conn->query($query)) {
            $upload = "images/";
            $target_file = $upload.basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $target_file);

            header("location: sellershome.php");
            exit();
        } else {
            echo "<div class='alert' style='background-color: pink'>Failed to Add Product</div>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $checker = new Checker();
    $file = $_FILES['picture'];
    $validation_result = $checker->pic_validate($file);

    if($validation_result !== true){
        echo $validation_result;
        exit();    
    }

    $name = $_POST['pdname'];
    $price = $_POST['pdprice'];
    $cat_id = $_POST['category_id'];

    $product = new products($name, $price, $cat_id);
    $product->add_product();
}
?>

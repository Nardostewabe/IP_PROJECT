<?php
require_once "Database_connection.php";

class ProductModel extends Database_connection {
    private $name;
    private $price;
    private $cat_id;
    private $file;

    public function __construct($name, $price, $cat_id, $file) {
        $this->name = $name;
        $this->price = $price;
        $this->cat_id = $cat_id;
        $this->file = $file;
    }

    private function validateImage($file) {
        $allowed_types = ['image/png', 'image/jpg', 'image/jpeg'];
        $file_type = mime_content_type($file['tmp_name']);
        $max_size_mb = 1;
        $file_size = round($file['size'] / (1024 * 1024), 3);

        if (!in_array($file_type, $allowed_types)) {
            return "Invalid file type $file_type. Allowed types: " . implode(", ", $allowed_types);
        }

        if ($file_size > $max_size_mb) {
            return "File size exceeds 1 MB. Your file is $file_size MB.";
        }

        return true;
    }

    public function addProduct() {
        session_start();
        $conn = $this->connect();
        $validation_result = $this->validateImage($this->file);

        if ($validation_result !== true) {
            echo $validation_result;
            exit();
        }

        $name = $conn->real_escape_string($this->name);
        $price = (float) $this->price;
        $cat_id = (int) $this->cat_id;
        $pic_url = $conn->real_escape_string($this->file['name']);
        $sid = $_SESSION['SID'];

        $query = "INSERT INTO products (product_name, price, image_url, cat_id, sid) 
                  VALUES ('$name', $price, '$pic_url', $cat_id, $sid)";

        if ($conn->query($query)) {
            move_uploaded_file($this->file['tmp_name'], "images/" . basename($this->file['name']));
            header("location: sellershome.php");
            exit();
        } else {
            echo "<div class='alert' style='background-color: pink'>Failed to Add Product</div>";
        }
    }
    
}
?>

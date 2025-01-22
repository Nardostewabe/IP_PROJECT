<?php
require_once "Database_connection.php";

class patterns extends Database_connection{
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function add_pattern(){
        $db = new Database_connection();
        $conn = $db->connect();
        session_start();
        $pdf_url = $_FILES['pdf']['name'];
        $sid = $_SESSION['SID'];

        $query = "INSERT INTO patterns (pat_name, pat_price, pat_image_url, sid) VALUES ('$this->name', $this->price, '$pdf_url', $sid)";

        $result = $conn->query($query);

        if ($result) {
            $conn->close();
            header("location: categories.php");
            exit();  // Ensure the script stops execution after redirection
        } else {
            echo "
            <a href='users.php'> 
                <div class='alert' style='background-color: pink'>
                    <span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>&times;</span>
                    Failed to Add pattern.
                </div>
             </a>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $upload = "Patterns/";
        $target_file = $upload . basename($_FILES['pdf']['name']);

        if (move_uploaded_file($_FILES['pdf']['tmp_name'], $target_file)) {
            // Only process if the file was successfully uploaded
            $name = $_POST['ptname'];
            $price = $_POST['ptprice'];

            // Fix the class instantiation
            $pattern = new patterns($name, $price);
            $pattern->add_pattern();
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
} else {
    echo "Invalid request.";
}
?>

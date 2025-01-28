<?php
require_once "Database_connection.php";
require_once "Checker.php";

class patterns extends Database_connection {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function add_pattern() {
        session_start();

        $conn = $this->connect();
        
        $name = $conn->real_escape_string($this->name);
        $price = (float) $this->price;
        $pdf_url = $conn->real_escape_string($_FILES['pdf']['name']);
        $sid = $_SESSION['SID'];

        $query = "INSERT INTO patterns (pat_name, pat_price, pat_pdf_url, sid) 
                  VALUES ('$name', $price, '$pdf_url', $sid)";

        if ($conn->query($query)) {
           
            $upload = "Patterns/";
            $target_file = $upload . basename($_FILES['pdf']['name']);
            move_uploaded_file($_FILES['pdf']['tmp_name'], $target_file);
            header("location: sellershome.php");
            exit(); 
        } else {
            echo "<div class='alert' style='background-color: pink'>Failed to Add Pattern</div>";
        }

    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $checker = new Checker();
    $file = $_FILES['pdf'];
    $validation_result = $checker->pdf_validate($file);
    if($validation_result !== true){
        echo $validation_result;
        exit();    
    }

    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $name = $_POST['ptname'];
        $price = $_POST['ptprice'];

        $pattern = new patterns($name, $price);
        $pattern->add_pattern();
    } else {
        echo "No file uploaded or an error occurred.";
    }
}
?>

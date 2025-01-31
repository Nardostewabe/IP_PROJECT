<?php
require_once "Database_connection.php";

class PatternModel extends Database_connection {
    private $name;
    private $price;
    private $file;

    public function __construct($name, $price, $file) {
        $this->name = $name;
        $this->price = $price;
        $this->file = $file;
    }

    private function validatePDF($file) {
        $allowed_type = 'application/pdf';
        $file_type = mime_content_type($file['tmp_name']);
        $max_size_mb = 3;
        $file_size = round($file['size'] / (1024 * 1024), 3);

        if ($file_type !== $allowed_type) {
            return "Invalid file type $file_type. Allowed type: PDF.";
        }

        if ($file_size > $max_size_mb) {
            return "File size exceeds 3 MB. Your file is $file_size MB.";
        }

        return true;
    }

    public function addPattern() {
        session_start();
        $conn = $this->connect();
        $validation_result = $this->validatePDF($this->file);

        if ($validation_result !== true) {
            echo $validation_result;
            exit();
        }

        $name = $conn->real_escape_string($this->name);
        $price = (float) $this->price;
        $pdf_url = $conn->real_escape_string($this->file['name']);
        $sid = $_SESSION['SID'];

        $query = "INSERT INTO patterns (pat_name, pat_price, pat_pdf_url, sid) 
                  VALUES ('$name', $price, '$pdf_url', $sid)";

        if ($conn->query($query)) {
            move_uploaded_file($this->file['tmp_name'], "Patterns/" . basename($this->file['name']));
            header("location: sellershome.php");
            exit();
        } else {
            echo "<div class='alert' style='background-color: pink'>Failed to Add Pattern</div>";
        }
    }
}
?>

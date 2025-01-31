<?php
require_once "PatternModel.php";

class PatternController {
    public function addPattern($name, $price, $file) {
        $pattern = new PatternModel($name, $price, $file);
        $pattern->addPattern();
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $controller = new PatternController();
        $controller->addPattern($_POST['ptname'], $_POST['ptprice'], $_FILES['pdf']);
    } else {
        echo "No file uploaded or an error occurred.";
    }
}
?>

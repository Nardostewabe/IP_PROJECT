<?php
require_once 'SellerSignUpModel';  

class SellerController {

    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->registerSeller();
        }
    }

    public function registerSeller() {
        $name = $_POST['uname'];
        $email = $_POST['em'];
        $pass = $_POST['pswd'];

        
        $sellerModel = new SellerModel();

        
        $result = $sellerModel->saveSellerData($name, $email, $pass);

        if ($result) {
          
            header("Location: SignUpView.php");
            exit();
        } else {
            
            echo "Sign Up failed. <a href='BecomeASelllerView.php'>Try again</a>";
        }
    }
}
new SellerController();
?>

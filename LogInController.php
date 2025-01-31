<?php
require_once "LoginModel.php";
session_start();

class LoginController {
    private $model;

    public function __construct() {
        $this->model = new LoginModel();
    }

    public function login($name, $email, $pass) {
        $user = $this->model->validateUser($name, $email, $pass);
        
        if ($user) {
            $_SESSION['usertype'] = "Customer";
            $_SESSION['UID'] = $user['UID'];
            $_SESSION['name'] = $user['username'];
            echo "<script>alert('Logged In Successfully.'); window.location.href = 'home.php';</script>";
            exit();
        }

        $seller = $this->model->validateSeller($name, $email, $pass);
        if ($seller) {
            $_SESSION['usertype'] = "Seller";
            $_SESSION['SID'] = $seller['sid'];
            $_SESSION['name'] = $seller['username'];
            echo "<script>alert('Logged In Successfully.'); window.location.href = 'sellershome.php';</script>";
            exit();
        }

        echo "<h2><strong>Login failed. Incorrect Username, Password, or Email.</strong></h2>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $controller = new LoginController();
    $controller->login($name, $email, $pass);
}
?>

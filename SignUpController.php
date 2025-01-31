<?php
require_once "SignUpModel.php";

class SignUpController {
    private $model;

    public function __construct() {
        $this->model = new SignUpModel();
    }

    public function register($name, $email, $pass) {
        if ($this->model->saveUser($name, $email, $pass)) {
            header("Location: LogInView.php");
            exit();
        } else {
            echo "<script>alert('SignUp failed.'); window.location.href = 'SignUpView.php';</script>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $controller = new SignUpController();
    $controller->register($name, $email, $pass);
}
?>

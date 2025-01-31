<?php
session_start();
require_once "ViewOrderModel.php";

if (!isset($_SESSION['UID'])) {
    echo "User is not logged in. Please log in first.";
    exit();
}

if ($_SESSION['usertype'] == 'Customer') {
    $uid = $_SESSION['UID'];
} elseif ($_SESSION['usertype'] == 'Seller') {
    $uid = $_SESSION['SID'];
} else {
    echo "Invalid user type.";
    exit();
}

$user_role = $_SESSION['usertype'];


$orderModel = new ViewOrderModel();
$orders = $orderModel->fetchOrders($uid, $user_role);

?>
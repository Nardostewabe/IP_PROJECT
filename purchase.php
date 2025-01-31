<?php
session_start();
require_once 'PurchaseController.php';

if (isset($_GET['name']) && isset($_GET['price'])) {
    $purchaseController = new PurchaseController();
    $purchaseController->processPurchase($_GET['name'], $_GET['price']);
} else {
    echo "Product does not exist.";
}
?>

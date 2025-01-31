<?php
require_once 'PurchaseModel.php';

class PurchaseController {
    public function processPurchase($name, $price) {
        if (!isset($_SESSION['UID'])) {
            header("location:SignUpView.php");
            exit();
        }

        $purchase = new PurchaseModel($name, $price);
        $result = $purchase->addOrder();

        if ($result) {
            header("location:Vieworders.php");
            exit();
        } else {
            echo "Failed to process purchase.";
        }
    }
}
?>

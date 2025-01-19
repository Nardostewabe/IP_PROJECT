<?php
require_once "Database_connection.php";

session_start();

class purchase extends Database_connection{
    private $name;
    private $price;
    
    public  function __construct($name,$price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function add_to_my_orders(){
       $connect = new Database_connection();
       $conn = $connect->connect();

       $uid = $_SESSION['UID'];
       $date = date('Y-m-d');
       $sid = 1;
       $query = "INSERT INTO orders (UID,sid,order_name,order_price,order_date) VALUES ($uid,$sid,'$this->name','$this->price',$date)";

       $result = $conn->query($query);

       if($result){
        header("location:orders.php");
       }

       else{
        die("Failed to purchase");
       }
    }
}
if(!$_SESSION){
    header("location:loginto.php");
}
elseif(isset($_GET['name']) && isset($_GET['price'])){
    $purchased = new purchase($_GET['name'],$_GET['price']);

    $purchased->add_to_my_orders();
    }

else{
        echo "Product Does not exist";
    }
?>
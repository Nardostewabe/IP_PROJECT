<?php
require_once "Database_connection.php";

class products extends Database_connection{
    private $name;
    private $price;
    private $picturename;
    private $cat_id;

    public function __construct($name,$price,$cat_id) {
        $this->name = $name;
        $this->price = $price;
        $this->cat_id = $cat_id;
    }

    public function add_product(){

        $conn = $this->connect();
        session_start();

        $pic_url = $pic_url = $conn->real_escape_string($_FILES['picture']['name']);
        $sid = $sid = isset($_SESSION['SID']) ? $_SESSION['SID'] : 0;
        $query = "INSERT INTO products (product_name,price,image_url,cat_id,sid) values ('$this->name',$this->price,'$pic_url',$cat_id,$sid)";

        $result = $conn->query($query);
        
        if($result){
            $conn->close();
            header("location:categories.php");
            exit();
        }
        else{
            echo"
            <a href='users.php'> 
                <div class='alert' style = 'background-color: pink'>
                    <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                    Failed to Add pattern.
                </div>
             </a>";
        }
    }
}
if($_SERVER['REQUEST_METHOD']=="POST"){
    $name = $_POST['pdname'];
    $price = $_POST['pdprice'];
    $cat_id = $_POST['category_id'];
    $picname = 'picture';

    $upload = "images/";
    $target_file = $upload . basename($_FILES['picture']['name']);

    if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
        $pattern = new products($name, $price, $cat_id);
        $pattern->add_product();
    }
}



?>
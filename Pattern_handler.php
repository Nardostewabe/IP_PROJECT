<?php
require_once "Database_connection.php";

class patterns extends Database_connection{
    private $name;
    private $price;
    private $picturename;

    public function __construct($name,$price,$picname) {
        $this->name = $name;
        $this->price = $price;
        $this->picturename = $picname;
    }

    public function add_pattern(){

        $conn = $this->connect();

        $pdf_url = $_FILES[$this->picturename]['name'];
        $sid = $_SESSION['SID'];

        $query = "INSERT INTO patterns (pat_name,pat_price,pat_image_url,sid) values ('$this->name',$this->price,'$pdf_url',$sid)";

        $result = $conn->query($query);

        if($result){
            header("location:categories.php");
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
    $name = $_POST['ptname'];
    $price = $_POST['ptprice'];
    $picname = 'pdf';

        $upload = "D:Patterns/";
        $target_file = $upload.basename($_FILES['pdf']['name']);
        $fileup = move_uploaded_file($_FILES['pdf']['tmp_name'],$target_file)
$pattern new = pattern($name,$price,$picname);
$pattern->add_pattern();
}
?>
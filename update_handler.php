<?php
require_once "Database_connection.php";
?>
<link rel="stylesheet" href="stylesheets/usercard.css">
<?php
class update extends Database_connection{
    private $new_name;
    private $new_password;

    public function __construct($new_name,$new_password){
        $this->new_name = $new_name;
        $this->new_password = $new_password;
    }

    public function set_new_data(){
        if ($_SESSION['usertype']=="Customer"){
            session_start();
            $uid = $_SESSION['UID'];
            $db = new Database_connection();
            $conn = $db->connect();

            $query= "UPDATE users SET username = '$this->new_name' , password1 = '$this->new_password' WHERE UID = $uid";

            $result = $conn->query($query);

            if($result){
                $_SESSION['name']=$this->new_name;
                header("location:users.php");
            }

            else{
                echo "
                <a href='users.php'> 
                    <div class='alert' style = 'background-color: pink'>
                        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                        Failed to update data.
                    </div>
                 </a>";
            }
        }
        elseif ($_SESSION['usertype']=="Seller") {
            session_start();
            $sid = $_SESSION['SID'];
            $conn = $this->connect();
            $query= "UPDATE sellers SET username = '$this->new_name' , password1 = '$this->new_password' WHERE sid = $sid";

            $result = $conn->query($query);

            if($result){
                $_SESSION['name']=$this->new_name;
                header("location:users.php");
            }

            else{
                echo "
                <a href='users.php'> 
                    <div class='alert' style = 'background-color: pink'>
                        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                        Failed to update data.
                    </div>
                 </a>";
            }
        }
    }
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $new_name = $_POST['name'];
    $new_password = $_POST['password'];

$updateme = new update($new_name,$new_password);
$updateme->set_new_data();
}

else{
    echo "
                <a href='users.php'> 
                    <div class='alert' style = 'background-color: pink'>
                        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
                        You have not filled the form.
                    </div>
                 </a>";
}
?>
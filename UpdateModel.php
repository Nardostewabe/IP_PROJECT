<?php
require_once "Database_connection.php";

class UpdateModel extends Database_connection {
    private $new_name;
    private $new_password;

    public function __construct($new_name, $new_password) {
        $this->new_name = $new_name;
        $this->new_password = $new_password;
    }

    public function updateUserProfile() {
        session_start();
        $conn = $this->connect();

        
        if ($_SESSION['usertype'] == "Customer") {
            $uid = $_SESSION['UID'];
            $query = "UPDATE users SET username = '$this->new_name', password1 = '$this->new_password' WHERE UID = $uid";
        } elseif ($_SESSION['usertype'] == "Seller") {
            $sid = $_SESSION['SID'];
            $query = "UPDATE sellers SET username = '$this->new_name', password1 = '$this->new_password' WHERE sid = $sid";
        }

        
        $result = $conn->query($query);

        if ($result) {
            
            $_SESSION['name'] = $this->new_name;
            return true;
        }

        
        return false;
    }
}
?>

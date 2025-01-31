<?php

require_once "UpdateModel.php";

class UpdateController {

    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->updateProfile();
        }
    }

    private function updateProfile() {
        
        $new_name = $_POST['name'];
        $new_password = $_POST['password'];

        
        $updateProfileModel = new UpdateModel($new_name, $new_password);

        
        $result = $updateProfileModel->updateUserProfile();

        
        if ($result) {
            
            header("Location: users.php");
            exit();
        } else {
            
            echo "
                <a href='users.php'> 
                    <div class='alert' style='background-color: pink'>
                        <span class='closebtn' onclick='this.parentElement.style.display = 'none';'>&times;</span>
                        Failed to update data.
                    </div>
                </a>";
        }
    }
}

new UpdateController();
?>

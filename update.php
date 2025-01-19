<?php 

include_once = 'Database_connection.php';
include_once 'U_fetchuser.php';

$checker = isset($_POST['id'])
if($checker){
    $id = $_POST['id'];
}
else {
    $id = null;
}



if($id){
    $fetcher = new u_fetchuser();
    $userdata = $fetcher->fetchuser();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $updateHandler = new updte_handler();
    $updateHandler->handleUpdate();
}



if($userdata){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stylesheets\login.css">
</head>
<body>
    <p style = "font-size: 25px;">Update</p>  

<form action="update_handler.php" method="post"> 
    <div><input type="text" name="name" class = "Logger" value = <?php echo $userData['name'];?>> </div><br>
    <div><input type="Email" name="email" class = "Logger" value = <?php echo $userData['email'];?>> </div><br>
    <div><input type="password" name="password" class = "Logger" value = <?php echo $userData['password'];?>></div><br>
    <div><input type = "hidden" name = "id" value = <?php echo $userData['id'];?>></div>
    <div><input type="Submit" name="update" value = "Update" class = "Logger-button" ></div>
</form>
</body>
<script src="scripts/app.js"></script>
</html>

<?php } 
else {echo "User not found";}
}
else {echo "Invalid user ID."}

?>

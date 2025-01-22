<?php
session_start();
if($_SESSION){
require_once('Database_connection.php');
$db = new Database_connection();
$conn = $db->connect();

$query = "SELECT id, category_name FROM categories";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="stylesheets/seller.css">
    <link rel="stylesheet" href="stylesheets/style.css">
</head>
<body class = "container">  

<form action="Product_handler.php" method="post" enctype = "multipart/form-data"> 
    <fieldset>
        <legend>Add Product</legend>
    <label for="name">Enter Your Product's Name: </label>
    <input type="text" name="pdname"><br><br>
    <label for="price">Enter Your Product's Price: </label>
    <input type="text" name="pdprice"><br><br>
    <label for="pic">Product's picture</label>
    <input type="file" name="picture" id=""><br><br>
    <label for="category">Category: </label>
    <select name="category_id" required>
        <option value="">Select a Category</option>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
        }
        ?>
    </select><br><br>
    <input type="Submit" name="add" value = "Add product">
    </fieldset>
</form>
</body>
<script src="scripts/app.js"></script>
</html>
<?php
$conn->close();
}

else{
    echo "<a href='users.php'> 
    <div class='alert' style = 'background-color: pink'>
        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
        Failed to Add pattern.
    </div>
 </a>";
}
?>

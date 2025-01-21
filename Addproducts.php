<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="stylesheets/seller.css">
    <link rel="stylesheet" href="stylesheets/style.css">
</head>
<body>  

<form action="Product_handlers.php" method="post" enctype = "multipart/form-data"> 
    <fieldset>
        <legend>Add Product</legend>
    <label for="name">Enter Your Product's Name: </label>
    <input type="text" name="pdname"><br><br>
    <label for="price">Enter Your Product's Price: </label>
    <input type="text" name="pdprice"><br><br>
    <label for="price">Enter Your Product's Category: </label>
    <input type="text" name="pdcat"><br><br>
    <label for="pic">Product's picture</label>
    <input type="file" name="picture" id=""><br><br>
    <input type="Submit" name="add" value = "Add">
    </fieldset>
</form>
</body>
<script src="scripts/app.js"></script>
</html>

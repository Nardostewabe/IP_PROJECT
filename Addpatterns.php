<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add patterns</title>
    <link rel="stylesheet" href="stylesheets/seller.css">
    <link rel="stylesheet" href="stylesheets/style.css">
</head>
<body>  

<form action="Pattern_handlers.php" method="post"> 
    <fieldset>
        <legend>Add Pattern</legend>
    <label for="name">Enter Your Pattern's Name: </label>
    <input type="text" name="ptname"><br><br>
    <label for="price">Enter Your Pattern's Price: </label>
    <input type="text" name="ptprice"><br><br>
    <label for="pic">Pattern's PDF</label>
    <input type="file" name="pdf" id=""><br><br>
    <input type="Submit" name="add" value = "Add">
    </fieldset>
</form>
</body>
<script src="scripts/app.js"></script>
</html>

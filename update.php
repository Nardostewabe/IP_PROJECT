<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="stylesheets/forms.css">
    <link rel="stylesheet" href="stylesheets/style.css">
</head>
<body>  

<form action="update_handler.php" method="post"> 
    <fieldset>
        <legend>UPDATE</legend>
    <label for="newname">Enter Your New Name: </label>
    <input type="text" name="name"><br><br>
    <label for="newpass">Enter Your New Password</label>
    <input type="password" name="password"><br><br>
    <input type="Submit" name="update" value = "Update">
    </fieldset>
</form>
</body>
<script src="scripts/app.js"></script>
</html>

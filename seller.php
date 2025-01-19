<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become A Seller</title>
    <link rel="stylesheet" href="stylesheets/seller.css">
</head>
<body class = "container">
<form action= "Register.php" method="post"> 
    <fieldset>
        <legend>Welcome to crochet</legend>
        <p>Sign up to kick start your crochet business</p>
    <div><input type="text" name="uname" placeholder="Name" class = "Logger" id="inp"> </div><br>
    <div><input type="Email" name="em" placeholder="Email" class = "Logger" id="inp"> </div><br>
    <div><input type="password" name="pswd" placeholder="Password" class = "Logger" id="pass" onblur="f()"></div><br>
    <div class="msg"></div>
    <div><input type="password" name="pswd2" placeholder="Confirm Password"class = "Logger" id="pass2" onblur="g()"></div> <br> 
    <div class="msg2"></div>
    <div><input type="Submit" name="login" value = "Sign Up" class = "Logger-button" ></div>  
    </fieldset>
</form>
</body>
<script src="scripts/app.js"></script>
</html>
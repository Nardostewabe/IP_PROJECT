<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crochet.com</title>
    <link rel="stylesheet" href="stylesheets\style.css">
    <link rel="stylesheet" href="stylesheets/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="stylesheets\footer.css">
    <link rel="stylesheet" href="stylesheets/usercard.css">
</head>
<body background="images/back.jpeg">
    <nav class="navbar">
        <div class="navbar__container">
            <a href = "#"><img src="images\CROCHET.png" alt=" " class="navbar__logo"></a>
            <div class="navbar__toggle" id="mobile-menu">
                <span class = "bar"></span>
                <span class = "bar"></span>
                <span class = "bar"></span>
            </div>
            <ul class="navbar__menu">
                <li class="navbar__item">
                <?php
                    session_start();
                    if(!$_SESSION){
                        echo "<a href='home.php' class='navbar__link'>Home</a>";
                        echo "
                        </li>
                        <li class='navbar__item'>
                            <a href='explore.php' class='navbar__link'>Explore</a>
                        </li>
                        <li class='navbar__btn'>
                            <a href='loginto.php' class='button'>Sign Up</a>
                        </li>
                        <li>
                            <div class='search'>
                                <form action = 'SearchHandler.php' method = 'POST' >
                                    <input type='search' placeholder='Search for items'>
                                    <button type='submit'>Go</button>
                                </form>
                            </div>
                        </li>";
                    }
                    else{
                    if($_SESSION['usertype'] == "Seller"){
                        echo "<a href='sellershome.php' class='navbar__link'>Home</a>";
                    }
                    else{
                        if($_SESSION['usertype'] == "Customer"){

                        echo "<a href='home.php' class='navbar__link'>Home</a>";
                        echo "</li>
                        <li class='navbar__item'>
                            <a href='explore.php' class='navbar__link'>Explore</a>
                        </li>
                        <li>
                            <div class='search'>
                                <form >
                                    <input type='search' placeholder='Search for items'>
                                    <button type='submit'>Go</button>
                                </form>
                            </div>
                        </li>";
                        }
                    }
                    }
                    ?>
                    <li class='navbar__item'>
                    <a href="About.php" class="navbar__link">About us</a>
                </li>

            </ul>
        </div>
    </nav>
<?php
if(!$_SESSION){
    ?>
    

<a href="loginto.php"> 
    <div class="alert" style = "background-color: pink">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  You have not logged in.
    </div>
</a>

    <?php
}

else{
?>
    <div class="container">
        <div class="profile-box">
        <h3 id="logout"><a href="logout.php"><i class="bx bx-log-out"></i>LOG OUT</a></h3>
            <img src="images\profile.png" class="profile-pic">
            <h1><?php echo $_SESSION['name'];?></h1>
            <h2><?php echo $_SESSION['usertype'];?></h2>
            <?php
            if($_SESSION['usertype']=="Seller"){
                echo "<h3>Your Seller Id is: ".$_SESSION['SID']."</h3>";
                echo "<h4><a href='update.php'>Update Your Profile</a></h4>";
                echo "<h4><a href='delete.php' style='color: red;'>Delete Account</a></h4>";

            }

            elseif($_SESSION['usertype']=="Customer"){
                echo "<h3>Your User Id is: ".$_SESSION['UID']."</h3>";
                echo "<a href='seller.php'><h3>Become A Seller</h3></a>";
                echo "<h4><a href='update.php'>Update Your Profile</a></h4>";
                echo "<h4><a href='delete.php' style='color: red;'>Delete Account</a></h4>";

            }
            ?>
        </div>
    </div>
    </body>
<script src="scripts\app.js"></script>
</html>
<?php
}
?>

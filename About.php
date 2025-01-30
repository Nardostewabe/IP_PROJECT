<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crochet.com</title>
    <link rel="stylesheet" href="stylesheets\style.css">
    <link rel="stylesheet" href="stylesheets/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="stylesheets/general.css">
    <link rel="stylesheet" href="stylesheets/footer.css">
</head>
<style>
    body{
        background-repeat:repeat;
        background-size:contain;
    }
</style>
<body style="background-color: bisque;">
    <div class="navbar">
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
                                <form >
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
                                <form action = 'SearchHandler.php' method = 'POST'>
                                    <input type='text' placeholder='Search for items' name = 'searchQuery'>
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
    </div>
    <div class="sidebar">
        <div class="top">
            <i class="bx bx-menu" id="btn"></i>
        </div> 
        <ul>
            <li>
                <a href="users.php">
                    <i class="bx bx-user"></i>
                    <span class="side-item">user</span>
                </a>
                <span class="tooltip">User</span>
              </li>    
          <li>
            <a href="categories.php">
                <i class="bx bx-list-ul"></i>
                <span class="side-item">Products</span>
            </a>
             <span class="tooltip">Products</span>
          </li>  
          <li>
            <a href="pattern.php">
                <i class="bx bxs-notepad"></i>
                <span class="side-item">Popular Patterns</span>
            </a>
             <span class="tooltip">Popular Patterns</span>
          </li> 
          <li>
            <a href="patterns.php">
                <i class="bx bxs-notepad"></i>
                <span class="side-item">Patterns</span>
            </a>
             <span class="tooltip">Patterns</span>
          </li> 
          <li>
            <a href="Vieworders.php">
                <i class="bx bxs-cart-alt"></i>
                <span class="side-item">Order</span>
            </a>
             <span class="tooltip">Order</span>
          </li>     
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="images\profile.png" alt=" ">
                    <div class="name_job">
                        <div class="name" name = "uname" id="names"><?php if($_SESSION){echo $_SESSION['name'];}
                        else{
                        echo "Username";
                        }?></div>
                    </div>
                </div>
                <a href="logout.php"><i class="bx bx-log-out" id="logout"></i></a>
            </div>
        </div>
    </div>    <div class="bod">
            <div>
                <h1>About us</h1><br>
                <p>Welcome to CROCHET, where creativity meets craftsmanship! Our platform is dedicated to bringing together talented crochet artisans and enthusiasts from around the world.</p><br>
            </div>
            <div>
                <br><h3>Our story</h3><br>
                <p>CROCHET was founded with a passion for the timeless art of crochet and a vision to create a global community that celebrates and supports handmade crochet creations. We believe in the beauty and uniqueness of handmade products and are committed to providing a space where artisans can showcase their work and connect with customers who appreciate the skill and love that goes into each piece.</p><br>
            </div>
            <div>
                <h3>What we offer</h3><br>
                <ul>
                    <li>Unique Crochet Creations: Discover a wide range of handmade crochet items, from clothing and accessories to home decor and gifts.</li>
                    <br><li>Support for Artisans: We empower artisans with the resources they need to market and sell their creations effectively</li>
                    <br><li>Community Engagement: Join our interactive community of crochet enthusiasts, share your projects, and connect with fellow artisans.</li>
                    <br><li>Educational Resources: Learn and improve your crochet skills with our tutorials, workshops, and resources.</li>
                    <br><li>Sustainability: We encourage the use of eco-friendly materials and practices to support a sustainable future.</li>
                </ul><br>
            </div>
            <div>
                <p>____________________________________________________________________________________________________________________________</p>
            </div><br>
            <div>
                <br><h2>Join Us</h2><br>
                <p>Whether you’re an artisan looking to share your work or a customer searching for unique, handmade crochet products, CROCHET is the place for you. Join us in celebrating the artistry and creativity of crochet. <br>
                    <br> Thank you for being a part of our community! <br> <br>
                    Warm Regards, <br> <br>
                    The CROCHET Team</p><br>
                <img src="images\CROCHET.png" alt="n" width="300px" height="140px">
            </div>
        </div>
        <footer>
            <div class="footercontainer">
                <div class="socialicons">
                    <a href=""><i class="bx bxl-facebook"></i></a>
                    <a href=""><i class="bx bxl-instagram"></i></a>
                    <a href=""><i class="bx bxl-gmail"></i></a>
                    <a href=""><i class="bx bxl-google-plus"></i></a>
                    <a href=""><i class="bx bxl-youtube"></i></a>
                </div>
                <div class="footernav">
                    <ul>
                        <li><a href="">News</a></li>
                        <li><a href="">Our Team</a></li>
                        <li><a href="">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footerbottom">
                    <p>Copy right &copy;2024; Designed By <span class="designer">Crochet Team</span></p>
                </div>
            </div>
        </footer>
</body>
<script src="scripts\app.js"></script>
</html>

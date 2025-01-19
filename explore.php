<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crochet.com</title>
    <link rel="stylesheet" href="stylesheets\style.css">
    <link rel="stylesheet" href="stylesheets/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="stylesheets\general.css">
    <link rel="stylesheet" href="stylesheets/footer.css">
</head>
<body>
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
                    <a href="home.php" class="navbar__link">Home</a>
                </li>
                <li class="navbar__item">
                    <a href="explore.php" class="navbar__link">Explore</a>
                </li>
                <li class="navbar__item">
                    <a href="About.php" class="navbar__link">About us</a>
                </li>
                <?php
                session_start();
                if (!$_SESSION){
                    echo "
                <li class='navbar__btn'>
                    <a href='loginto.php' class='button'>Sign Up</a>
                </li>
                <li>
                ";}?>
                <li>
                    <div class="search">
                        <form >
                            <input type="search" placeholder="Search for items">
                            <button type="submit">Go</button>
                        </form>
                    </div>
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
                <span class="side-item">Patterns</span>
            </a>
             <span class="tooltip">Patterns</span>
          </li> 
          <li>
            <a href="orders.php">
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
                        <div class="name" name = "uname" id="names"><?php 
                        if($_SESSION){echo $_SESSION['name'];}
                        else{
                        echo "Username";
                        }?></div>
                    </div>
                </div>
                <a href="logout.php"><i class="bx bx-log-out" id="logout"></i></a>
            </div>
        </div>
    </div>
    <center>
        <h1><em><b>ONLINE SHOP</b></em></h1>
        <p class="longpar" ="font-size: 20px;">"Welcome to our captivating explore page! Discover this week's top selections below"</p>
        <p>__________________________________________________________________________________________________________________________________________</p>
    </center>
    <table class="s2">
        <tr>
            <td><a href="images\tiny dino.png"><img src="images\tiny dino.png" alt="n"></a></td>
            <td><a href="images\basket.jpeg"><img src="images\basket.jpeg" alt="n"></a></td>
            <td><a href="images\Granny bag.avif"><img src="images\Granny bag.avif" alt="n"></a></td>
            <td><a href="images\dress.jpeg"><img src="images\dress.jpeg" alt="n"></a></td>
        </tr>
        <tr class="name">
            <td>Dino keychains</td>
            <td>Bear basket</td>
            <td>Granny square tote bag</td>
            <td>Full set(infant)</td>
        </tr>
        <tr class="price">
            <td>200ETB</td>
            <td>1700ETB</td>
            <td>800ETB</td>
            <td>3500ETB</td>
        </tr>
        <tr class="purchase">
            <td><a href="purchase.php" id = "pur">Purchase</a></td>
            <td><a href="purchase.php" id = "pur">Purchase</a></td>
            <td><a href="purchase.php" id = "pur">Purchase</a></td>
            <td><a href="purchase.php" id = "pur">Purchase</a></td>
        </tr>
    </table>
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

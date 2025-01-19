<?php
session_start();
if(!$_SESSION){
    if(!$_SESSION){
        ?>
        
    <link rel="stylesheet" href="stylesheets/usercard.css">
    <a href="loginto.php"> 
        <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      You have not logged in.
        </div>
    </a>
    
        <?php
    }
}
?>

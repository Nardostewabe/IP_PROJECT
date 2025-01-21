<?php 
require_once "Database_connection.php";

class orders{

}
session_start();
if(!$_SESSION){
    if(!$_SESSION){
        ?>
        
    <link rel="stylesheet" href="stylesheets/usercard.css">
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
        <?php
    }
}
?>

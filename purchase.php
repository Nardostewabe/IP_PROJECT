<?php
session_start();

if(!$_SESSION){
    header("location:loginto.php");
}
?>
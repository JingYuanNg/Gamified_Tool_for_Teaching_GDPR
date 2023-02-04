<?php
require_once "headerFooterClient.php";
unset($_SESSION['anyone']);
unset($_SESSION['aftLoggedIn']); 
unset($_SESSION['pName']);
session_destroy(); 
$location = "login.php";
echo "<script type='text/javascript'>alert('You have successfully been logout!');window.location='$location'</script>";
?>
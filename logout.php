<?php
session_start();
unset($_SESSION["pName"]);
session_destroy(); 
header ("Location: login.php");
?>
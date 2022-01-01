<?php
session_start();

// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['valid'] = false;
$_SESSION['timeout'] = "";
$_SESSION['username'] = "";
header('Location: ../index.php');

?>

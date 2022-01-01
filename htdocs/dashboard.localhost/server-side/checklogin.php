<?php
session_start();
include_once "connection.php";
$conn=connessione();

$myusername=$_POST['username'];
$mypassword=$_POST['password'];
$password=md5($mypassword);
$sql="SELECT * FROM users WHERE username='$myusername' and password='$password'";
$result=mysqli_query($conn,$sql);
$count=mysqli_num_rows($result);

if($count==1){

$_SESSION['valid'] = true;
$_SESSION['timeout'] = time();
$_SESSION['username'] = $myusername;
header('Location: ../dashboard.php');
}
else {
header('Location: ../index.php');
}
?>

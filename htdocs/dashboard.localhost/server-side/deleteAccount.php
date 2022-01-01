<?php
session_start();
include_once "connection.php";
$conn=connessione();
$user=$_POST['id'];
$result = mysqli_query ($conn,'delete from users where id='.$user.'') or die("L'utente non esiste " .mysql_error());;
?>

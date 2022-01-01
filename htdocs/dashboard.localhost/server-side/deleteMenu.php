<?php
session_start();
include_once "connection.php";
$conn=connessione();
$menu=$_POST['id'];
$result = mysqli_query ($conn,'delete from panino where id='.$menu.'') or die("L'utente non esiste " .mysql_error());;
?>

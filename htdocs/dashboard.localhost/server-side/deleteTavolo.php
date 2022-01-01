<?php
session_start();
include_once "connection.php";
$conn=connessione();
$tavolo=$_POST['id'];
$result = mysqli_query ($conn,'delete from tavolo where id='.$tavolo.'') or die("L'utente non esiste " .mysql_error());;
?>

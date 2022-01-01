<?php
session_start();
include_once "connection.php";
$conn=connessione();

$id=$_POST['id'];
$newsala=$_POST['sala'];
$newtable=$_POST['table'];
$sql='UPDATE tavolo SET sala='.$newsala.', posto='.$newtable.' WHERE id='.$id.'';
$result = mysqli_query ($conn,$sql) or die("Il tavolo non esiste " .mysql_error(). $sql);;
echo $sql;
?>

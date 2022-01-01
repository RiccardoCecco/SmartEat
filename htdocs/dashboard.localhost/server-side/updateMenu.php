<?php
session_start();
include_once "connection.php";
$conn=connessione();

$id=$_POST['id'];
$newname=$_POST['name'];
$newcosto=$_POST['costo'];
$newingredienti=$_POST['ingredienti'];
$sql='UPDATE panino SET nome="'.$newname.'", costo="'.$newcosto.'", ingrediente="'.$newingredienti.'" WHERE id='.$id.'';
$result = mysqli_query ($conn,$sql) or die("L'utente non esiste " .mysql_error(). $sql);;
echo $sql;
?>

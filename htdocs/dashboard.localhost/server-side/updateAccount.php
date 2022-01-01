<?php
session_start();
include_once "connection.php";
$conn=connessione();

$id=$_POST['id'];
$newusername=$_POST['username'];
$newname=$_POST['name'];
$newlastname=$_POST['lastname'];
$newdatanascita=$_POST['datanascita'];
$newprivilegi=$_POST['privilegi'];
$sql='UPDATE users SET username="'.$newusername.'", nome="'.$newname.'", cognome="'.$newlastname.'", privilegi="'.$newprivilegi.'", dataNascita="'.$newdatanascita.'" WHERE id='.$id.'';
$result = mysqli_query ($conn,$sql) or die("L'utente non esiste " .mysql_error(). $sql);;
echo $sql;
?>

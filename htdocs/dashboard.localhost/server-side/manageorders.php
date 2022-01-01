<?php
session_start();
include_once "connection.php";
$conn=connessione();
$order=$_POST['id'];
$operation=$_POST['operation'];
if($operation ==1){
  $result = mysqli_query ($conn,'delete from ordine where id='.$order.'') or die("L'ordine non esiste " .mysql_error());;
}
if ($operation ==2) {
  $result = mysqli_query ($conn,'UPDATE ordine SET stato=0 WHERE id='.$order.'') or die("L'ordine non esiste " .mysql_error());;
}
?>

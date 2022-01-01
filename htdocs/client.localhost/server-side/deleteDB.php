<?php
  $tavolo=$_POST['idTavolo'];

  session_start();
  include_once "connection.php";
  $conn=connessione();
  $sql="DELETE FROM ordiniprovvisori WHERE idTavolo='$tavolo'";
  $result=mysqli_query($conn,$sql) or die("Sbagliata" .mysql_error());
 ?>

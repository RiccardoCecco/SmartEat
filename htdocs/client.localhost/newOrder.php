<?php
session_start();
include_once "server-side/connection.php";
$conn=connessione();
  $tavolo=$_POST['idTavolo'];

  $sql1="SELECT * FROM ordiniprovvisori WHERE idTavolo='$tavolo'";
  $result1=mysqli_query($conn,$sql1);
  $count1=mysqli_num_rows($result1);
  $boll;
  if ($count1 != 0){
    while($order = mysqli_fetch_array($result1)){
      $sql2="SELECT * FROM ordine WHERE idTavolo='$tavolo'";
      $result2=mysqli_query($conn,$sql2);
      $count2=mysqli_num_rows($result2);
      if($count2 != 0){
        while($existorder=mysqli_fetch_array($result2)){
          if($order[1] == $existorder[1]){
            $quantitagiusta=$existorder['quantita'];
            $quantitagiusta=$quantitagiusta+$order['quantita'];
            $sql6="UPDATE ordine SET quantita=".$quantitagiusta." WHERE idTavolo=".$tavolo;
            $boll=mysqli_query($conn,$sql6) or die("Sbagliata" .mysql_error());
          }else{
            $stato=1;
            $sql="INSERT INTO ordine (idPanino, idTavolo, stato,quantita) VALUES  ('".$order[1]."','".$tavolo."','".$stato."','".$order[3]."')";

            $boll=mysqli_query($conn,$sql) or die("Sbagliata" .mysql_error());
          }
        }
      }else{
        $stato=1;
        $sql="INSERT INTO ordine (idPanino, idTavolo, stato,quantita) VALUES  ('".$order[1]."','".$tavolo."','".$stato."','".$order[3]."')";

        $boll=mysqli_query($conn,$sql) or die("Sbagliata" .mysql_error());
      }
    }
  }
?>

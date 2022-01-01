<?php
session_start();
include_once "connection.php";
$conn=connessione();
//  foreach($_POST as items){
//    if(empty(items)){
//      echo "vuoto";
//      exit();
//    }
//  }
  $newname=$_POST['name'];
  $newcosto=$_POST['costo'];
  $newingredienti=$_POST['ingredienti'];
//  $data=date("Y/m/d",strtotime($newdatanascita));
//  $dataArray= split("/",$data);
//  $newdatanascita= $dataArray[0]."-".$dataArray[1]."-".$dataArray[2];
  $sql="INSERT INTO panino (nome, costo, ingrediente) VALUES  ('".$newname."','".$newcosto."','".$newingredienti."')";
  $boll=mysqli_query($conn,$sql) or die("Sbagliata" .mysql_error());
//  echo "$newmatricola-$newusername-$newpassword-$newname-$newlastname-$newprivilegi-$newdatanascita";
  if($boll){
//  require 'account.php';
  return "true";
}else{
  //require 'newAccount.php';
  return "false";
}
//  header('Location: dashboard.php');
// Mysql_num_row is counting table row
?>

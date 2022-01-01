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
  $newsala=$_POST['sala'];
  $newtable=$_POST['table'];
//  $data=date("Y/m/d",strtotime($newdatanascita));
//  $dataArray= split("/",$data);
//  $newdatanascita= $dataArray[0]."-".$dataArray[1]."-".$dataArray[2];
  $sql="INSERT INTO tavolo (sala, posto) VALUES  ('".$newsala."','".$newtable."')";
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

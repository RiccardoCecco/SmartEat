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
$operation=$_POST['operazione'];
$iduser=$_POST['iduser'];
if($operation==1){
    $operation=$_POST['operazione'];
    $newusername=$_POST['username'];
    $newpassword=$_POST['password'];
    $newname=$_POST['name'];
    $newlastname=$_POST['lastname'];
    $newdatanascita=$_POST['datanascita'];
    $newprivilegi=$_POST['privilegi'];

    $password=md5($newpassword);
    $data=date("d/m/Y",strtotime($newdatanascita));
    $dataArray= split("/",$data);
    $newdatanascita= $dataArray[2]."-".$dataArray[1]."-".$dataArray[0];
    $sql="INSERT INTO users (username, password, nome, cognome, privilegi, dataNascita) VALUES  ('".$newusername."','".$password."','".$newname."','".$newlastname."','". $newprivilegi."','".$newdatanascita ."')";
    $boll=mysqli_query($conn,$sql) or die("Sbagliata" .mysql_error());
  //  echo "$newmatricola-$newusername-$newpassword-$newname-$newlastname-$newprivilegi-$newdatanascita";
    if($boll){
  //  require 'account.php';
    return "true";
  }else{
    //require 'newAccount.php';
    return "false";
  }
}elseif ($operation==2) {
  $sql="UPDATE users SET ";
  $c=0;

  if(isset($_POST['username'])){
  $newusername=$_POST['username'];
  $sql=$sql."username='".$newusername."'";
  $c=1;
  }
  if(isset($_POST['password'])){
    if($c==1){
      $sql=$sql.",";
    }
    $oldpassword=md5($_POST['oldpassword']);

    $result = mysqli_query ($conn,"select password from users where id=".$iduser);
    $id=1;

    while($password = mysqli_fetch_array($result)) {
      if($password['password'] == $oldpassword){

        $newpassword=md5($_POST['password']);
        $c=1;
        $sql=$sql."password='".$newpassword."'";
      }else{
        echo  "false";
      }
    }
  }

  if(isset($_POST['name'])){
  $newname=$_POST['name'];

    if($c==1){
      $sql=$sql.",";
    }
    $c=1;
    $sql=$sql."nome='".$newname."'";
  }

  if(isset($_POST['lastname'])){
  $newlastname=$_POST['lastname'];

    if($c==1){
      $sql=$sql.",";
    }
  $c=1;
  $sql=$sql."cognome='".$newlastname."'";
  }

  if(isset($_POST['datanascita'])){
  $newdatanascita=$_POST['datanascita'];

    if($c==1){
      $sql=$sql.",";
    }
  $c=1;
  $sql=$sql."dataNascita='".$newdatanascita."'";
  }
  $sql=$sql." WHERE id=".$iduser;
  $boll=mysqli_query($conn,$sql) or die("Sbagliata" .mysql_error());
}
//  header('Location: dashboard.php');
// Mysql_num_row is counting table row
?>

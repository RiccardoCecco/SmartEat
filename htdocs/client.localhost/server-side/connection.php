<?php

function connessione(){
  $host="localhost";
  $username="root";
  $password="";
  $db_name="fastfood";

  $conn=mysqli_connect($host,$username,$password,$db_name);
//  mysql_set_charset('utf8',$conn);
  return $conn;
}

?>

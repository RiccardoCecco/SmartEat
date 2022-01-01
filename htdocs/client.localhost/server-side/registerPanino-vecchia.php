<?php
  $register=$_POST['function'];
  session_start();
  include_once "connection.php";
  $conn=connessione();

  $costototale=0;
    if($register=="register"){




      $paninoorder=$_POST['idPanino'];
      $quantita=$_POST['quantita'];
      $tavolo=$_POST['idTavolo'];
//controllo per modificare la tabella in base ai panino che si vuole ordinare, se il panino già esiste aggiornerò la quantità richiesta
      $sql5="SELECT * FROM ordiniprovvisori WHERE idTavolo='$tavolo' AND idPanino='$paninoorder'";
      $result3=mysqli_query($conn,$sql5);
      $count3=mysqli_num_rows($result3);
      if ($count3 != 0){
        $quantitagiusta=$quantita;
        $order3 = mysqli_fetch_assoc($result3);
        $quantitagiusta=$quantitagiusta+$order3['quantita'];
        $sql6="UPDATE ordiniprovvisori SET quantita=".$quantitagiusta." WHERE id=".$order3['id'];
        $boll=mysqli_query($conn,$sql6) or die("Sbagliata" .mysql_error());
      }
      else{
        //nuovo ordine
        $sql="INSERT INTO ordiniprovvisori (idPanino, idTavolo, quantita) VALUES  ('" .$paninoorder."','".$tavolo."','".$quantita."')";
        $boll=mysqli_query($conn,$sql) or die("Sbagliata" .mysql_error());
      }

      //creo la tabella nel dialog
      $sql2="SELECT * FROM ordiniprovvisori WHERE idTavolo='$tavolo'";
      $result=mysqli_query($conn,$sql2);
      $count=mysqli_num_rows($result);
      if ($count != 0){
        echo "<h3>YOUR ORDER:<h3>";
        echo "<table style='width:100%; margin: 30px 30px 30px 30px;'>";
        echo "<tr><th>Images</th><th>Quantity</th><th>Name</th></tr>";

        while($order = mysqli_fetch_array($result)) {
              $sql3="select * from panino WHERE id=".$order['idPanino'];
              $result2 = mysqli_query ($conn,$sql3);
            $id=0;
            while($panino = mysqli_fetch_array($result2)) {

              $srcimage;
              if(file_exists("../images/food/". $panino['nome'].".jpg")){
                $srcimage="../images/food/". $panino['nome'].".jpg";
              }
              elseif(file_exists("../images/food/". $panino['nome'].".png")){
                 $srcimage="../images/food/". $panino['nome'].".png";
              }else {
                $srcimage="../images/food/default-food.png";
              }

            echo "<tr class='tr-image'><td class='tr-image' ><img src='".$srcimage."' alt='' class='image' id='images' /></td><td class='lista'>". $order['quantita']."</td> <td class='lista'>". $panino['nome']."</td> </tr>";
            $costo=$panino['costo']*$order['quantita'];
            $costototale=$costototale+$costo;

            echo "</table>";

          $id=$id+1;
            }

          }


      }
    }else{
      $tavolo=$_POST['idTavolo'];
      $sql2="SELECT * FROM ordiniprovvisori WHERE idTavolo='$tavolo'";
      $result=mysqli_query($conn,$sql2);
      $count=mysqli_num_rows($result);
      if ($count != 0){
        echo "<h3>YOUR ORDER:<h3>";
        echo "<table  style='width:100%; margin: 30px 30px 30px 30px;>";
        echo "<tr><th>Images</th><th>Quantity</th><th>Name</th></tr>";
        while($order = mysqli_fetch_array($result)) {
              $sql3="select * from panino WHERE id=".$order['idPanino'];
              $result2 = mysqli_query ($conn,$sql3);

            while($panino = mysqli_fetch_array($result2)) {

              $srcimage;
              if(file_exists("../images/food/". $panino['nome'].".jpg")){
                $srcimage="../images/food/". $panino['nome'].".jpg";
              }
              elseif(file_exists("../images/food/". $panino['nome'].".png")){
                 $srcimage="../images/food/". $panino['nome'].".png";
              }else {
                $srcimage="../images/food/default-food.png";
              }
            echo "<tr class='tr-image'><td class='tr-image' ><img src='".$srcimage."' alt='' class='image' id='images' /></td><td class='lista'>". $order['quantita']."</td> <td class='lista'>". $panino['nome']."</td> </tr>";
            $costo=$panino['costo']*$order['quantita'];
            $costototale=$costototale+$costo;
            }
          }
            echo "</table>";
    }
  }
    echo "<div><label><font style='color:black; font-size:24px;'>".$costototale." €</font></label><div/>";

    /*  $order = new stdClass;
      $order->panino = $paninoorder;
      $order->quantita = $quantita;
      $order->stato = $stato;
      $order->tavolo =   $tavolo; */
    /*  $array = array(
      "panino" => $paninoorder,
      "quantita" => $quantita,
      "stato" => $stato,
      "tavolo" => $tavolo
    );*/
    //  $order=array($paninoorder,$quantita,$tavolo);
    //  echo $order[0];
/*    if($id==0){
      $bool=primoOrdine($order);
    }else{
      $bool=setOrdini($order);
    }
*/
    //  echo $bool;
  /*    $orders=getOrdini();
      if(empty($orders)){
        echo "ciao3";
      }*/
    //  array_push($orders,$order);

  //    echo $orders[0];
  //    $numorders=count($orders);
  //    echo $numorders;
    /*  if($numorders == 0){
        for($i = 0; $i <= $numorders; $i++){
          if(empty($orders[$numorders])){
            $orders[$numorders] = $order;
            }
          }
      }*/

?>

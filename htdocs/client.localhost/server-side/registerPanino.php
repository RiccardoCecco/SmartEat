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

        while($order = mysqli_fetch_array($result)) {
              $sql3="select * from panino WHERE id=".$order['idPanino'];
              $result2 = mysqli_query ($conn,$sql3);
            $id=1;
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

            $costo=$panino['costo']*$order['quantita'];
            $costototale=$costototale+$costo;

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
        $id=1;
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
                $srcimage="../images/food/panino.jpg";
              }
              $colourscaldi  = array("#EF5350", "#EC407A", "#66BB6A", "#9CCC65","#D4E157", "#FFEE58","#FFA726", "#FF7043");
              $coloursfreddi  = array("#7E57C2", "#5C6BC0", "#42A5F5",  "#29B6F6","#26C6DA", "#26A69A", "#26A69A");
              $max;
              $c=$id%2;
              if($c ==0){
                $max = count($colourscaldi);
              }else{
                $max = count($coloursfreddi);
              }
              $number = rand(1,$max);
              $bgcolour;

              if($c ==0){
                $bgcolour = $colourscaldi[$number - 1];
              }else{
                $bgcolour = $coloursfreddi[$number - 1];
              }

              echo "<div style='margin: 2% 2% 0% 2%'><div style='background-color: ".$bgcolour."; border-style: solid;  border-width: 3px;' class='demo-card-wide mycard mdl-shadow--2dp ' id='card".$id."'><div class='mdl-card__supporting-text'>";
              echo "<table ><tr><td ><img src='".$srcimage."' alt='' class='image' id='images' /></td><td>". $order['quantita']."</td> <td>". $panino['nome']."</td> </tr></table>";
              echo "</div></div></div>";

            $costo=$panino['costo']*$order['quantita'];
            $costototale=$costototale+$costo;
            $id=$id+1;

            }
          }
            echo "</table>";
    }
  }
    echo "<div style='margin: 2% 0px 0px 0px'>";
    echo "<div class='leftprezzo'><label><font style='color:black; font-size:24px;'>".$costototale." €</font></label></div>";
    echo "<div class='myright'><button type='button' onclick='invocareOrdine(".$tavolo.")' class='mdl-button'><img src='icon/ic_payment_black_24px.svg' /></button></div></div>";
    echo "</div>";
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

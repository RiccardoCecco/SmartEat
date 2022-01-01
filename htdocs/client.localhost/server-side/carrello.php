
  <?php

      session_start();
      include_once "connection.php";
      $conn=connessione();
      $paninoorder=$_POST['idPanino'];
      $quantita=$_POST['quantita'];
      $tavolo=$_POST['idTavolo'];
      $stato=$_POST['stato'];
      $sql="select * from panino WHERE id=".$paninoorder;
      $result = mysqli_query ($conn,$sql);

      $id=1;
      echo "<table>";
    while($panino = mysqli_fetch_array($result)) {

      $srcimage;
      if(file_exists("../images/food/". $panino['nome'].".jpg")){
        $srcimage="../images/food/". $panino['nome'].".jpg";
      }
      elseif(file_exists("../images/food/". $panino['nome'].".png")){
         $srcimage="../images/food/". $panino['nome'].".png";
      }else {
        $srcimage="../images/food/default-food.png";
      }
       echo "<tr class='tr-image'><td class='tr-image' ><img src='".$srcimage."' alt='' class='image' id='image".$id."' /></td><td class='lista'>". $quantita."</td> <td class='lista'>". $panino['nome']."</td> </tr>";
      //  echo "<label><font>".$paninoorder." e".$quantita."</font></label>";
    }
      echo "</table>";
      echo "<li class='myright'><a onclick=''><i class='material-icons'>payment</i>Pay</a></li>";

    //  $id=$id+1;
  ?>

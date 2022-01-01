<div>
  <h3 style="text-align:center;">Your Order:</h3>
    <div style="text-align:right;">
      <?php
        $tavolo=$_POST["idTavolo"];
        echo "<button style='background-color: blue;' class='mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored' onclick='showNew(".$tavolo.")'><img src='icon/ic_mode_edit_black_24px.svg' /></button>";
      ?>

  </div>
</div>

<ul>
<?php
  include_once "server-side/connection.php";
  $conn=connessione();
  $tavolo=$_POST["idTavolo"];

  $result = mysqli_query ($conn,'select * from ordine where idTavolo='.$tavolo);
  $id=1;
  while($order = mysqli_fetch_array($result)) {
    $result2 = mysqli_query ($conn,'select * from panino where id='.$order['idPanino']);
    $id=1;
    while($panino = mysqli_fetch_array($result2)) {

  //    echo "<li class='lista'> panino='". $panino['nome']."'<a onclick='newClientOrder(".$panino['id'].")' class='myright'><i class='material-icons'>add</i></a></li>";
        $srcimage;
        if(file_exists("images/food/". $panino['nome'].".jpg")){
          $srcimage="images/food/". $panino['nome'].".jpg";
        }
        elseif(file_exists("images/food/". $panino['nome'].".png")){
           $srcimage="images/food/". $panino['nome'].".png";
        }else {
          $srcimage="images/food/panino.jpg";
        }
        //echo "<tr><td>".$tavolo."</td><td>".$tavolo."</td><td>".$tavolo."</td><td>".$tavolo."</td><td>".$tavolo."</td><tr>";
      // echo "<tr><td class='tr-image' ><div style='text-align:center;'><img src='".$srcimage."' alt='' class='image' id='image".$id."' ></div></td><td class='lista'><div style='text-align:center;'><label ><font style='color:black; text-align:center; font-size:18;'>". $panino['nome']."</font></label></div></td> <td class='tr-quantita' ><input type='number' id='quantita".$id."' name='quantita' value='1' step='1' required='required' min='1' onChange='updatePrice(".$panino['costo'].",".$id.")'/></td><td class='lista'><div style='position: static;align-items:center;text-align:center;'> <label ><font style='color:black; text-align:center; font-size:18;'>".$panino['costo']." €</font></label></div> </td> <td class='lista'> <div style='text-align:center;'><label ><font id='costo".$id."' style='color:black; font-size:18;'>".$panino['costo']." €</font></label></div> </td><td class='lista'><div style='text-align:center;'><button type='button' id='$idbutton' onclick='newClientOrder(".$componenti.")' class='myright'><i  class='material-icons'>add</i></button></div></td></tr>";
      $stato=null;
      switch ($order['stato']) {
          case 0:
              $stato="In preparation";
              break;
          case 1:
              $stato="it will soon be your turn";
              break;
        }
        echo "<li><img src='".$srcimage."' alt='' class='image' id='image".$id."' > Quantità: ".$order['quantita']." ".$stato."  </li>";


        $id=$id+1;
    }
  }

  echo "</ul>";

 ?>
 <script type="text/javascript">
 $('#orderfatto').css('display','none');
 $('#show-modal-example').css('display','none');

 function showNew(tavolo) {
   var dataString="idTavolo="+tavolo;
   $.ajax({
     url: "menu.php",
     type: "POST",
     data:dataString,
     dataType: 'html',
     success: function(result){
       dropDB(tavolo);
       $("#sectionContent").empty();
       $("#sectionContent").html(result);
       $('#orderfatto').css('display','block');
       $('#show-modal-example').css('display','block');

     }
 });
 }

 function dropDB(tavolo){
   var dataString="idTavolo="+tavolo;

   $.ajax({
     url: "server-side/deleteDB.php",
     type: "POST",
     data:dataString,
     dataType: 'html',
     error: function(jqXHR, textStatus, errorThrown) { // errore nell'effettuare la chiamata!
               alert('An error ... Look at the console for more information!');
       console.log('jqXHR:');
               console.log(jqXHR);
               console.log('textStatus:');
               console.log(textStatus);
               console.log('errorThrown:');
               console.log(errorThrown);
             }
 });
 }

 function reload(){
           $.ajax({
             url: "menu.php",
             success: function(result){
               $("#content").empty();
               $("#content").append(result);
             }
         });
 }
 </script>

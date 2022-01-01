<div class="mycard" >
    <div class="card ">
        <div style="justify-content: center;align-items: center;position: static;"><h1 class="mycardtitle">Menù</h1> </div>
        <div style="overflow-y: auto;">


              <?php
              $tavolo=$_POST["idTavolo"];
              include_once "server-side/connection.php";
              $conn=connessione();

              $result = mysqli_query ($conn,'select * from panino');
              $id=1;
              while($panino = mysqli_fetch_array($result)) {

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
                  $componenti=$panino['id'].",".$id.",".$tavolo;
                  $idbutton="demo-show-snackbar";
                // echo "<tr><td class='tr-image' ><div style='text-align:center;'><img src='".$srcimage."' alt='' class='image' id='image".$id."' ></div></td><td class='lista'><div style='text-align:center;'><label ><font style='color:black; text-align:center; font-size:18;'>". $panino['nome']."</font></label></div></td> <td class='tr-quantita' ><input type='number' id='quantita".$id."' name='quantita' value='1' step='1' required='required' min='1' onChange='updatePrice(".$panino['costo'].",".$id.")'/></td><td class='lista'><div style='position: static;align-items:center;text-align:center;'> <label ><font style='color:black; text-align:center; font-size:18;'>".$panino['costo']." €</font></label></div> </td> <td class='lista'> <div style='text-align:center;'><label ><font id='costo".$id."' style='color:black; font-size:18;'>".$panino['costo']." €</font></label></div> </td><td class='lista'><div style='text-align:center;'><button type='button' id='$idbutton' onclick='newClientOrder(".$componenti.")' class='myright'><i  class='material-icons'>add</i></button></div></td></tr>";
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

                echo "<div style='margin: 2% 5% 0% 5%'><div style='background-color: ".$bgcolour."; border-style: solid;  border-width: 5px;' class='demo-card-wide mycard mdl-shadow--2dp ' id='card".$id."'><div class='mdl-card__supporting-text'>";
                echo "<table><tr><td ><div style='text-align:center;'><img src='".$srcimage."' alt='' class='image' id='image".$id."' ></div></td><td ><div ><label ><font style='color:black; font-size:24;'>". $panino['nome']."</font></label></div></br></br><div style='max-width 70%;'><label ><font style='color:black;font-size:18;'>Ingredients:  ". $panino['ingrediente']."</font></label></div></td> <td  ><input type='number' id='quantita".$id."' name='quantita' value='1' step='1' required='required' min='1' onChange='updatePrice(".$panino['costo'].",".$id.")'/></td> <td > <div style='text-align:center;'><label ><font id='costo".$id."' style='color:black; font-size:18;'>".$panino['costo']." €</font></label></div> </td><td ><div style='text-align:center;'><button type='button' id='$idbutton' onclick='newClientOrder(".$componenti.")' class='myright'><img src='icon/ic_add_black_24px.svg'/></button></div></td></tr></table>";
                echo "</div> </div></div>";

                  $id=$id+1;
              }
              ?>
            </div>
          </div>

      </div>



          </table>
        </div>
      </div>

    </div>
</div>
<script type="text/javascript">



var orders={};
$('#show-modal-example').css('display','none');



function updatePrice(costo,id) {
          var total =  parseFloat(costo, 10,00) * parseFloat(document.getElementById('quantita'+id).value, 10,00);
          var string="#costo"+id;
          $(string).text(total+" €");
}

function controlloOrdine(dati){
  var dataString=dati;
  var x = document.getElementById("modal-example");
  $('#orderfatto').css('display','block');
  x.close();
    $.ajax({
      url: "controlsOrder.php",
      type: "POST",
      data:dataString,
      dataType: 'html',
      success: function(result){
          $("#sectionContent").empty();
          $("#sectionContent").append(result);
      //    $("#profile-dropdown").empty();
      //    $("#profile-dropdown").append(result);
      },
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

function invocareOrdine(tavolo) {
  var dataString="idTavolo="+tavolo;
  //var ordinec={ idPanino, quantita};
  //orders.push(ordinec);

  $.ajax({
    url: "newOrder.php",
    type: "POST",
    data:dataString,
    dataType: 'html',
    success: function(result){
      alert("L'ordine è stato inviato");
      alert(result);
      controlloOrdine(dataString);
    //    $("#profile-dropdown").empty();
    //    $("#profile-dropdown").append(result);
    },
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

function viewOrder(tavolo) {
  var dataString="function=view&idTavolo="+tavolo;

  //var ordinec={ idPanino, quantita};
  //orders.push(ordinec);

  $.ajax({
    url: "server-side/registerPanino.php",
    type: "POST",
    data:dataString,
    dataType: 'html',
    success: function(result){
        $("#content").empty();
        $("#content").append(result);
    //    $("#profile-dropdown").empty();
    //    $("#profile-dropdown").append(result);
    },
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


/*
<script>*/
/*(function() {
  'use strict';

}());*/

function newClientOrder(idPanino,id,tavolo) {
  $('#show-modal-example').css('display','block');
  var quantita=parseFloat(document.getElementById('quantita'+id).value, 10,00);
  var dataString="idPanino="+idPanino+"&idTavolo="+tavolo+"&quantita="+quantita+"&function=register";
  //var ordinec={ idPanino, quantita};
  //orders.push(ordinec);

  var d = document.getElementById("food")
  d.className = "show";
  setTimeout(function(){ d.className = d.className.replace("show", ""); }, 3000);

  $.ajax({
    url: "server-side/registerPanino.php",
    type: "POST",
    data:dataString,
    dataType: 'html',
    success: function(result){
        $("#content").empty();
        $("#content").append(result);
    //    $("#profile-dropdown").empty();
    //    $("#profile-dropdown").append(result);
    },
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

</script>

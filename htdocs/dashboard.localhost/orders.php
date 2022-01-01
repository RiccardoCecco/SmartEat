<h5>In Preparation :</h5>
      <ul>

            <?php
            include_once "server-side/connection.php";
            $conn=connessione();

            $result = mysqli_query ($conn,'select * from tavolo');
            $id=1;
            while($tavolo = mysqli_fetch_array($result)) {
              $colourscaldi  = array("", "#F44336", "#673AB7", "#FF9800","#03A9F4", "#FF5722","#2196F3", "#FF7043");

              echo "<li><div style='margin: 2% 5% 0% 5%'><div style='background-color: ".$colourscaldi[$id]."; border-style: solid;  border-width: 2px;' class='demo-card-wide mycard mdl-shadow--2dp ' id='card".$id."'><div class='mdl-card__title'><h2 class='mdl-card__title-text'>Tavolo ".$tavolo['id']."</h2></div><div class='mdl-card__supporting-text'><ul>";
              $cercapanino = mysqli_query ($conn,'select * from ordine where idTavolo='.$tavolo['id'].' AND stato=0');
                while($orders = mysqli_fetch_array($cercapanino)) {
                  $paninoquery= mysqli_query($conn,"select * from panino where id=".$orders['idPanino']);
                  $righe=mysqli_num_rows($paninoquery);
                  if($righe >0 ){
                      while($panino= mysqli_fetch_array($paninoquery)){
                      //  echo "<li id='".$orders['id']."'>Tavolo n.'".$orders['idTavolo']."'  Nome Panino: '". $panino['nome']."' Quantita n. '".$orders['quantita']."'<a onclick='deleteOrder(".$orders['id'].")' class='waves-effect waves-light btn'><i class='material-icons'>delete</i></a></li>";
                        echo "<li id='".$orders['id']."'> Nome Panino: '". $panino['nome']."' Quantita n. '".$orders['quantita']."'  <a style='text-align:right;position:relative;'  onclick='deleteOrder(".$orders['id'].")' class='waves-effect waves-light btn'><img src='icon/ic_delete_black_24px.svg'/></a></li>";

                        }
                      }else{
                        echo "<li> There aren't order from this table</li>";
                      }
                  }

          //    echo "<li id='".$orders['id']."'>Tavolo n.'".$orders['idTavolo']."'  Nome Panino: '". $panino['nome']."' Quantita n. '".$orders['quantita']."'<a onclick='deleteOrder(".$orders['id'].")' class='waves-effect waves-light btn'><img src='icon/ic_delete_black_24px.svg'/></a></li>";
          //    echo "<table><th class='th'>Images</th><th class='th'>Name</th><th>Start Price</th><th class='th'>Quantitaty</th><th class='th'>Price</th><th class='th'></th><tr><td ><div style='text-align:center;'><img src='".$srcimage."' alt='' class='image' id='image".$id."' ></div></td><td ><div ><label ><font style='color:black; font-size:24;'>". $panino['nome']."</font></label></div></br></br><div style='max-width 70%;'><label ><font style='color:black;font-size:18;'>Ingredients:  ". $panino['ingrediente']."</font></label></div></td><td ><div style='position: static;align-items:center;text-align:center;'> <label ><font style='color:black; text-align:center; font-size:18;'>".$panino['costo']." €</font></label></div> </td> <td  ><input type='number' id='quantita".$id."' name='quantita' value='1' step='1' required='required' min='1' onChange='updatePrice(".$panino['costo'].",".$id.")'/></td> <td > <div style='text-align:center;'><label ><font id='costo".$id."' style='color:black; font-size:18;'>".$panino['costo']." €</font></label></div> </td><td ><div style='text-align:center;'><button type='button' id='$idbutton' onclick='newClientOrder(".$componenti.")' class='myright'><img src='icon/ic_add_black_24px.svg'/></button></div></td></tr></table>";
              echo "</ul></div> </div></div></li>";

                $id=$id+1;
            }
            ?>

      </ul>
<h5>To do :</h5>
      <ul>
            <?php
            include_once "server-side/connection.php";
            $conn=connessione();

            $result = mysqli_query ($conn,'select * from tavolo');
            $id=1;
            while($tavolo = mysqli_fetch_array($result)) {
              $colourscaldi  = array("", "#F44336", "#673AB7", "#FF9800","#03A9F4", "#FF5722","#2196F3", "#FF7043");


              echo "<li><div style='margin: 2% 5% 0% 5%'><div style='background-color: ".$colourscaldi[$id]."; border-style: solid;  border-width: 5px;' class='demo-card-wide mycard mdl-shadow--2dp ' id='card".$id."'><div class='mdl-card__title'><h2 class='mdl-card__title-text'>Tavolo ".$tavolo['id']."</h2></div><div class='mdl-card__supporting-text'><ul>";
                $cercapanino = mysqli_query ($conn,'select * from ordine where idTavolo='.$tavolo['id'].' AND stato=1');
                  while($orders = mysqli_fetch_array($cercapanino)) {
                    $paninoquery= mysqli_query($conn,"select * from panino where id=".$orders['idPanino']);
                    $righe=mysqli_num_rows($paninoquery);
                    if($righe >0){
                        while($panino= mysqli_fetch_array($paninoquery)){
                      //  echo "<li id='".$orders['id']."'>Tavolo n.'".$orders['idTavolo']."'  Nome Panino: '". $panino['nome']."' Quantita n. '".$orders['quantita']."'<a onclick='deleteOrder(".$orders['id'].")' class='waves-effect waves-light btn'><i class='material-icons'>delete</i></a></li>";
                        echo "<li id='".$orders['id']."'> Nome Panino: '". $panino['nome']."' Quantita n. '".$orders['quantita']."'<div style='text-align:right;position:relative;'><a onclick='changestato(".$orders['id'].")' class='waves-effect waves-light btn'><img src='icon/ic_add_black_24px.svg'/></a><a onclick='deleteOrder(".$orders['id'].")' class='waves-effect waves-light btn'><img src='icon/ic_delete_black_24px.svg'/></a></div></li>";

                        }
                      }
                  }

          //    echo "<li id='".$orders['id']."'>Tavolo n.'".$orders['idTavolo']."'  Nome Panino: '". $panino['nome']."' Quantita n. '".$orders['quantita']."'<a onclick='deleteOrder(".$orders['id'].")' class='waves-effect waves-light btn'><img src='icon/ic_delete_black_24px.svg'/></a></li>";
          //    echo "<table><th class='th'>Images</th><th class='th'>Name</th><th>Start Price</th><th class='th'>Quantitaty</th><th class='th'>Price</th><th class='th'></th><tr><td ><div style='text-align:center;'><img src='".$srcimage."' alt='' class='image' id='image".$id."' ></div></td><td ><div ><label ><font style='color:black; font-size:24;'>". $panino['nome']."</font></label></div></br></br><div style='max-width 70%;'><label ><font style='color:black;font-size:18;'>Ingredients:  ". $panino['ingrediente']."</font></label></div></td><td ><div style='position: static;align-items:center;text-align:center;'> <label ><font style='color:black; text-align:center; font-size:18;'>".$panino['costo']." €</font></label></div> </td> <td  ><input type='number' id='quantita".$id."' name='quantita' value='1' step='1' required='required' min='1' onChange='updatePrice(".$panino['costo'].",".$id.")'/></td> <td > <div style='text-align:center;'><label ><font id='costo".$id."' style='color:black; font-size:18;'>".$panino['costo']." €</font></label></div> </td><td ><div style='text-align:center;'><button type='button' id='$idbutton' onclick='newClientOrder(".$componenti.")' class='myright'><img src='icon/ic_add_black_24px.svg'/></button></div></td></tr></table>";
              echo "</ul></div> </div></div></li>";

                $id=$id+1;
            }
            ?>
    </ul>
<script type="text/javascript">

function deleteOrder(id) {
  var dataString="id="+id+"&operation=1";
  $.ajax({
    url: "server-side/manageorders.php",
    type: "POST",
    data:dataString,
    dataType: 'html',
    success: function(result){
      reload();
    }
});
}

function changestato(id) {
  var dataString="id="+id+"&operation=2";
  $.ajax({
    url: "server-side/manageorders.php",
    type: "POST",
    data:dataString,
    dataType: 'html',
    success: function(result){
      reload();
    }
});
}

function reload(){
          $.ajax({
            url: "orders.php",
            success: function(result){
              $("#content").empty();
              $("#content").append(result);
            }
        });
}
</script>

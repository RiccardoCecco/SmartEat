<?php
include_once "server-side/connection.php";
$conn=connessione();
$id=$_POST['id'];
$result = mysqli_query ($conn,"select * from panino where id=".$id);
while($panino= mysqli_fetch_array($result)) {
  $costo = number_format($panino['costo'], 2, '.', '');
  echo "<div class='demo-card-wide mdl-card mdl-shadow--2dp' style='width:80%;posiiton:absolute; text-align:center;'><div class='mdl-card__title' style='text-align:center;'><h2  class='mdl-card__title-text'>Altert Account</h2></div>";
  echo "<div class='mdl-card__supporting-text'><input pattern='[0-9]+([,\.][0-9]+)?' type='text' id='name' name='name' placeholder='Name' required='required' value='".$panino['nome']."' /><input type='number' id='costo' name='costo' placeholder='Cost' step='0.01' required='required' value=".$costo." /><input type='text' id='ingredienti' name='ingredienti' placeholder='Ingredients' required='required' value='".$panino['ingrediente']."' /></div>";
  echo"<div class='mdl-card__actions mdl-card--border'><a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' onclick='postData(".$panino['id'].")'>Change Account</a></div></div>";
}
?>
<script type="text/javascript">
function postData(id) {
  var name = $("#name").val();
  var costo = $("#costo").val();
  var ingredienti= $("#ingredienti").val();
  var dataString="id="+id+"&name="+name+"&costo="+costo+"&ingredienti="+ingredienti;
  $.ajax({
    url: "server-side/updateMenu.php",
    type: "POST",
    data: dataString,
      async:false,
    success: function(result){
      reload();
  //    $("#content").empty();
    //  $("#content").append(result);
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

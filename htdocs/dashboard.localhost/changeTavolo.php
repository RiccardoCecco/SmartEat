<?php
include_once "server-side/connection.php";
$conn=connessione();
$id=$_POST['id'];
$result = mysqli_query ($conn,"select * from tavolo where id=".$id);
while($tavolo= mysqli_fetch_array($result)) {
  echo "<div class='demo-card-wide mdl-card mdl-shadow--2dp' style='width:80%;posiiton:absolute; text-align:center;'><div class='mdl-card__title' style='text-align:center;'><h2  class='mdl-card__title-text'>Altert Account</h2></div>";
  echo "<div class='mdl-card__supporting-text'><input  type='text' id='sala' name='sala' placeholder='Room' required='required' value=".$tavolo['sala']." /><input  type='text' id='table' name='table' placeholder='Table' required='required' value=".$tavolo['posto']." /></div>";
  echo"<div class='mdl-card__actions mdl-card--border'><a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' onclick='postData(".$tavolo['id'].")'>Alter Table</a></div></div>";
}
?>
<script type="text/javascript">
function postData(id) {
  var sala = $("#sala").val();
  var table = $("#table").val();
  var ingredienti= $("#ingredienti").val();
  var dataString="id="+id+"&sala="+sala+"&table="+table;
  $.ajax({
    url: "server-side/updateTable.php",
    type: "POST",
    data: dataString,
      async:false,
    success: function(result){
      reload();
     //$("#content").empty();
    //$("#content").append(result);
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
            url: "table.php",
            success: function(result){
              $("#content").empty();
              $("#content").append(result);
            }
        });
}
</script>

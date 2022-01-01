<?php
session_start();
include_once "server-side/connection.php";
$conn=connessione();
if($_SESSION['valid'] ==""){
  header('Location: index.php');
}
?>



  <div class="demo-card-wide mdl-card mdl-shadow--2dp" style="width:80%;posiiton:absolute; text-align:center;">
    <div class="mdl-card__title" style="text-align:center;">
      <h2  class="mdl-card__title-text">New Menù</h2>
    </div>
    <div class="mdl-card__supporting-text">
      <input type="text" id="name" name="name" placeholder="Name" required="required" />
      <input type="number" id="costo" name="costo" placeholder="Cost" step="0.01" required="required" />
      <input type="text" id="ingredienti" name="ingredienti" placeholder="Ingredients" required="required" />
    </div>
    <div class="mdl-card__actions mdl-card--border">
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="postData()">
        Add Menù
      </a>
    </div>
  </div>

  <script type="text/javascript">
  function postData() {
    var name = $("#name").val();
    var costo = $("#costo").val();
    var ingredienti= $("#ingredienti").val();
    var dataString="&name="+name+"&costo="+costo+"&ingredienti="+ingredienti;
    $.ajax({
      url: "server-side/addPanino.php",
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

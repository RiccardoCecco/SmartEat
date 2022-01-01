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
      <h2  class="mdl-card__title-text">New Table</h2>
    </div>
    <div class="mdl-card__supporting-text">
      <input type="number" id="sala" name="sala" placeholder="Room" step="1" required="required" />
      <input type="number" id="table" name="table" placeholder="Table" step="1" required="required" />

    </div>
    <div class="mdl-card__actions mdl-card--border">
      <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="postData()">
        Add Table
      </a>
    </div>
  </div>

  <script type="text/javascript">
  function postData() {
    var sala = $("#sala").val();
    var table = $("#table").val();
    var dataString="sala="+sala+"&table="+table;
    $.ajax({
      url: "server-side/addTable.php",
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
      url: "table.php",
      success: function(result){
        $("#content").empty();
        $("#content").append(result);
      }
  });
  }
  </script>

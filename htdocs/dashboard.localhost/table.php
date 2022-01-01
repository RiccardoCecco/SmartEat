<div>

  <div>
    <h3 style="text-align:center;">Tables:</h3>
      <div style="text-align:right;"><button style="background-color: blue;" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="showNewTable()">
          <img src='icon/ic_add_black_24px.svg' />
      </button>
    </div>
  </div>

  <div>
    <ul class="collection">
      <?php
      include_once "server-side/connection.php";
      $conn=connessione();
      $result = mysqli_query ($conn,'select * from tavolo');


      while($tavolo = mysqli_fetch_array($result)) {
        echo "<li class='collection-item'> Tavolo ".$tavolo['id']."<p style='text-align:right;'><button onclick='changeTavolo(".$tavolo['id'].")' style='background-color: blue;' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'><img src='icon/ic_mode_edit_black_24px.svg' /></button><button onclick='deleteTavolo(".$tavolo['id'].")' style='background-color: blue;' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'><img src='icon/ic_delete_black_24px.svg' /></button></p></li>";
      }
      ?>
    </ul>
  </div>
<div>


<script type="text/javascript">
function showNewTable() {
  $.ajax({
    url: "newTavolo.php",
    dataType: 'html',
    success: function(result){
      $("#content").empty();
      $("#content").html(result);
    }
});
}

function deleteTavolo(id) {
  var dataString="id="+id;
  $.ajax({
    url: "server-side/deleteTavolo.php",
    type: "POST",
    data: dataString,
    success: function(result){
    //  $("#content").empty();
    //  $("#content").html(result);
    reload();
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

function changeTavolo(id) {
  var dataString="id="+id;
  $.ajax({
    url: "changeTavolo.php",
    type: "POST",
    data: dataString,
    success: function(result){
     $("#content").empty();
     $("#content").html(result);
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

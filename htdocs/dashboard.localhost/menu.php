<div>

  <div>
    <h3 style="text-align:center;">Menù:</h3>
      <div style="text-align:right;"><button style="background-color: blue;" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="showNewPanino()">
          <img src='icon/ic_add_black_24px.svg' />
      </button>
    </div>
  </div>

  <div>
    <ul class="collection">
      <?php
      include_once "server-side/connection.php";
      $conn=connessione();
      $result = mysqli_query ($conn,'select * from panino');


      while($panino = mysqli_fetch_array($result)) {
        echo "<li class='collection-item'>".$panino['nome']."<p style='text-align:right;'><button onclick='changeMenu(".$panino['id'].")' style='background-color: blue;' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'><img src='icon/ic_mode_edit_black_24px.svg' /></button><button onclick='deleteMenu(".$panino['id'].")' style='background-color: blue;' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'><img src='icon/ic_delete_black_24px.svg' /></button></p></li>";
      }
      ?>
    </ul>
  </div>
<div>


<script type="text/javascript">
function showNewPanino() {
  $.ajax({
    url: "newPanino.php",
    dataType: 'html',
    success: function(result){
      $("#content").empty();
      $("#content").html(result);
    }
});
}

function deleteMenu(id) {
  var dataString="id="+id;
  $.ajax({
    url: "server-side/deleteMenu.php",
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

function changeMenu(id) {
  var dataString="id="+id;
  $.ajax({
    url: "changeMenu.php",
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
            url: "menu.php",
            success: function(result){
              $("#content").empty();
              $("#content").append(result);
            }
        });
}
</script>

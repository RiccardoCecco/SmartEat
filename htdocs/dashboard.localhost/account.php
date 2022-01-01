<div>

  <div>
    <h3 style="text-align:center;">Account:</h3>
      <div style="text-align:right;"><button style="background-color: blue;" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" onclick="showNewAccount()">
          <img src='icon/ic_add_black_24px.svg' />
      </button>
    </div>
  </div>

  <div>
    <ul class="collection">
    <?php
    include_once "server-side/connection.php";
    $conn=connessione();
    $result = mysqli_query ($conn,'select * from users');
    while($user = mysqli_fetch_array($result)) {
      echo "<li class='collection-item'>".$user['username']."<p style='text-align:right;'><button onclick='changeAccount(".$user['id'].")' style='background-color: blue;' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'><img src='icon/ic_mode_edit_black_24px.svg' /></button><button onclick='deleteAccount(".$user['id'].")' style='background-color: blue;' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'><img src='icon/ic_delete_black_24px.svg' /></button></p></li>";
    }
    ?>
    </ul>
  </div>
<div>
<!--<div>
  <form>
      <button type="submit" class="btn btn-primary btn-block btn-large" onclick="showNewAccount()">New Account</button>
  </form>
</div>-->
<script type="text/javascript">
function showNewAccount() {
  $.ajax({
    url: "newAccount.php",
    success: function(result){
      $("#content").empty();
      $("#content").append(result);
    }
});
}

function deleteAccount(id) {
  var dataString="id="+id;
  $.ajax({
    url: "server-side/deleteAccount.php",
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

function changeAccount(id) {
  var dataString="id="+id;
  $.ajax({
    url: "changeAccount.php",
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
            url: "account.php",
            success: function(result){
              $("#content").empty();
              $("#content").append(result);
            }
        });
}
</script>

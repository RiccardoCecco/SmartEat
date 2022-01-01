
<?php
include_once "server-side/connection.php";
$conn=connessione();
$id=$_POST['id'];
$result = mysqli_query ($conn,"select * from users where id=".$id);
while($user= mysqli_fetch_array($result)) {
  echo "<div class='demo-card-wide mdl-card mdl-shadow--2dp' style='width:80%;posiiton:absolute; text-align:center;'><div class='mdl-card__title' style='text-align:center;'><h2  class='mdl-card__title-text'>Altert Account</h2></div>";
  echo "<div class='mdl-card__supporting-text'><h5>Name:</h5> <input type='text' id='name' name='name' placeholder='Name' value='".$user['nome']."' /> <h5>Last Name:</h5><input type='text' id='lastname' name='lastname' placeholder='Last Name' value='".$user['cognome']."' /> <h5>Username:</h5> <input type='text' id='username' name='username' placeholder='Username' value='".$user['username']."' /> <h5>Privileges:</h5><input type='number' id='privilegi' name='privilegi' placeholder='Privileges' value=".$user['privilegi']." /><h5>Birthday: </h5> <input type='date' id='datanascita' name='datanascita' placeholder='Birthday' value=".$user['dataNascita']." /></div>";
  echo"<div class='mdl-card__actions mdl-card--border'><a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' onclick='postData(".$user['id'].")'>Change Account</a></div></div>";
}
?>
<script type="text/javascript">
function postData(id) {
  var name = $("#name").val();
  var lastname = $("#lastname").val();
  var username = $("#username").val()
  var privilegi = $("#privilegi").val();
  var datanascita = $("#datanascita").val();
  var dataString= "id="+id+"&username="+username+"&name="+name+"&lastname="+lastname+"&privilegi="+privilegi+"&datanascita="+datanascita+"&operazione=1";
  $.ajax({
    url: "server-side/updateAccount.php",
    type: "POST",
    data: dataString,
      async:false,
    success: function(result){
      reload();

    //  $("#content").empty();
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
            url: "account.php",
            success: function(result){
              $("#content").empty();
              $("#content").append(result);
            }
        });
}



</script>

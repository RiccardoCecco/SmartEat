<div id='account' style="text-align:center; padding: 20px 20px 20px 20px;">

  <button style="background-color:blue;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="displayUser()">
    Change your Username
  </button>
  <button style="background-color:blue;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="displayName()">
    Change your Name
  </button>
  <button style="background-color:blue;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="displayLast()">
    Change your Last Name
  </button>
  <button style="background-color:blue;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="displayBirth()">
    Change your Birthday
  </button>
  <button style="background-color:blue;"  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="displayPassword()" >
    Change your Password
  </button>
<!--  <button style="background-color:blue;" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onclick="displayFile()" >
    Change your Profile Picture
  </button> -->
  <?php
  session_start();
  include_once "server-side/connection.php";
  $conn=connessione();
  $sql="SELECT * FROM users WHERE username='".$_SESSION['username']."'";
  $result=mysqli_query($conn,$sql);
  $user=mysqli_fetch_assoc($result);
  $name = $user['nome'];
  $lastname = $user['cognome'];
  $username = $user['username'];
  $password = $user['password'];
  $datanascita = $user['dataNascita'];
  $iduser= $user['id'];


  echo " <div id='card' style='align-content: center; display:none' class='row'><div class='col s12 m6'><div class='card blue-grey darken-1'><div class='card-content white-text'><span class='card-title'>Alter Your Account</span><div style='text-align:center;'>";
//  echo "<form onclick='upload()' enctype='multipart/form-data'><input type='file' name='image'id='image' /><input type='submit'/></form>";
  echo "<div id='divname' style='align-content: center; display:none'  class='row'><label><font> Your Name: </font></label><form class='col s12'><div class='row'><div class='input-field col s6'><input style='text-align: center;position:absolute;' placeholder='' id='name' type='text' class='validate'><label for='first_name'>$name</label></div></div></form></div>";
  echo "<div id='divlast' style='align-content: center; display:none'  class='row'><label><font> Last Name: </font></label><form class='col s12'><div class='row'><div class='input-field col s6'><input style='text-align: center;position:absolute;' placeholder='' id='lastname' type='text' class='validate'><label for='first_name'>$lastname</label></div></div></form></div>";
  echo "<div id='divuser' style='align-content: center; display:none'  class='row'><label><font> Userame: </font></label><form class='col s12'><div class='row'><div class='input-field col s6'><input style='text-align: center;position:absolute;' placeholder='' id='username' type='text' class='validate'><label for='first_name'>$username</label></div></div></form></div>";
  //echo "<div id='divpass' style='align-content: center; display:none' class='row'><form class='col s12'><div class='row'><div class='input-field col s6'><input placeholder='$password' id='password' type='password' class='validate'><label for='first_name'>Password</label></div></div></form></div>";

  echo "<div id='divoldpass' style='align-content: center; display:none' class='row'><label><font> Old Password: </font></label><div class='input-field col s12'><input style='text-align: center;' id='oldpassword' type='password' class='validate'><label for='password'></label></div></div>";
  echo "<div id='divnewpass' style='align-content: center; display:none' class='row'><label><font> New Password: </font></label><div class='input-field col s12'><input style='text-align: center;' id='newpassword' type='password' class='validate'><label for='password'></label></div></div>";
  echo "<div id='divconfpass' style='align-content: center; display:none' class='row'><label><font> Confirm your New Password: </font></label><div class='input-field col s12'><input style='text-align: center;' id='confpassword' type='password' class='validate'><label for='password'></label></div></div>";

  echo "<div id='divbirth' style='align-content: center; display:none' class='row'><label><font> Your Birthday: </font><form> <input style='text-align: center;' type='date' id='datanascita' class='datepicker' value='$datanascita'></form></div>";
//  echo "<div id='divfile' style='align-content: center; display:none' class='row'><div class='file-field input-field'><div class='btn'><span>Photo</span><input type='file'></div>  <div class='file-path-wrapper' id='path'><input class='file-path validate' type='text'></div></div></div>";
  echo "</div></div></div></div></div><button  id='button' style='align-content: center; display:none' onclick='updateData(\"$password\" , ".$iduser.")' type='submit' class='btn btn-primary btn-block btn-large'>Alter account</button>";



/*  echo "<input type='text' id='name' name='name' placeholder='$name' required='required' />";
  echo "<input type='text' id='lastname' name='lastname' placeholder='$lastname' required='required' />";;
  echo "<input type='text' id='username' name='username' placeholder='$username' required='required' />";
  echo "<input type='password' id='password' name='password' placeholder='$password' required='required' />";
  echo "<input type='date' id='datanascita' name='datanascita' value='$datanascita' required='required' />";*/
   ?>
  <div id="snackbar" > Error, New Passwords don't match!!</div>
  <div id="snackbar-diversa" > Error, try again!!</div>
  <div id="cambiamento" > The change was made!</div>
</div>
<script type="text/javascript">
var c;
function displayName() {
  c=0;
  display();
  $('#divname').css('display','block');

  $('#divlast').css('display','none');
  $('#divuser').css('display','none');
  $('#divbirth').css('display','none');
  $('#divoldpass').css('display','none');
  $('#divnewpass').css('display','none');
  $('#divconfpass').css('display','none');
//  $('#divfile').css('display','none');
}

function displayFile() {
  c=1;
  display();
  $('#divfile').css('display','block');

  $('#divlast').css('display','none');
  $('#divuser').css('display','none');
  $('#divbirth').css('display','none');
  $('#divoldpass').css('display','none');
  $('#divnewpass').css('display','none');
  $('#divconfpass').css('display','none');
  $('#divname').css('display','none');
}
function displayLast() {
  c=0;
  display();
  $('#divlast').css('display','block');

  $('#divname').css('display','none');
  $('#divuser').css('display','none');
  $('#divbirth').css('display','none');
  $('#divoldpass').css('display','none');
  $('#divnewpass').css('display','none');
  $('#divconfpass').css('display','none');
//  $('#divfile').css('display','none');
}
function displayBirth() {
  c=0;
  display();
  $('#divbirth').css('display','block');

  $('#divname').css('display','none');
  $('#divlast').css('display','none');
  $('#divuser').css('display','none');
  $('#divoldpass').css('display','none');
  $('#divnewpass').css('display','none');
  $('#divconfpass').css('display','none');
//  $('#divfile').css('display','none');
}
function displayUser() {
  c=0;
  display();
  $('#divuser').css('display','block');

  $('#divname').css('display','none');
  $('#divlast').css('display','none');
  $('#divbirth').css('display','none');
  $('#divoldpass').css('display','none');
  $('#divnewpass').css('display','none');
  $('#divconfpass').css('display','none');
//  $('#divfile').css('display','none');
}
function displayPassword() {
  c=0;
  display();
  $('#divoldpass').css('display','block');
  $('#divnewpass').css('display','block');
  $('#divconfpass').css('display','block');

  $('#divname').css('display','none');
  $('#divlast').css('display','none');
  $('#divuser').css('display','none');
  $('#divbirth').css('display','none');
//  $('#divfile').css('display','none');


}
function display(){
  $('#card').css('display','block');
  $('#button').css('display','block');
}

var data= $("#datanascita").val();

function updateData(passwordpassata,iduser) {
  if(c==0){
        var password=""+passwordpassata;
        var dataString="";
        var name = $("#name").val();
        if(name !=""){
          dataString=dataString+"name="+name;
        }

        var lastname = $("#lastname").val();
        if(lastname !=""){
          if(dataString==""){
            dataString=dataString+"lastname="+lastname;
          }else{
              dataString=dataString+"&lastname="+lastname;
          }
        }

        var username = $("#username").val();
        if(username !=""){
          if(dataString==""){
            dataString+="username="+username;
          }else{
            dataString+="&username="+username;
          }
        }

        var oldpassword = $("#oldpassword").val();
        var newpassword = $("#newpassword").val();
        var confpassword = $("#confpassword").val();
        if(password !=""){
          if(newpassword==confpassword){
            if(dataString==""){
              dataString+="password="+confpassword+"&oldpassword="+oldpassword;
            }else{
              dataString+="&password="+confpassword+"&oldpassword="+oldpassword;
            }
          }else{
            var x = document.getElementById("snackbar")
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
          }
        }else{
          var d = document.getElementById("snackbar-diversa")
          d.className = "show";
          setTimeout(function(){ d.className = d.className.replace("show", ""); }, 3000);
        }

        var datanascita = $("#datanascita").val();
        if(datanascita !="" && datanascita!=data){
          if(dataString==""){
            dataString+="datanascita="+datanascita;
          }else{
            dataString+="datanascita="+datanascita;
          }
        }
        if(dataString!=""){
          dataString+="&operazione=2";
          dataString+="&iduser="+iduser;
            $.ajax({
              url: "server-side/addAccount.php",
              type: "POST",
              data: dataString,
              success: function(result){
                if(result=="falseSbagliata"){
                  var g = document.getElementById("snackbar-diversa")
                  g.className = "show";
                  setTimeout(function(){ g.className = g.className.replace("show", ""); }, 3000);
                }else{
                  $('#divuser').css('display','none');
                  $('#divname').css('display','none');
                  $('#divlast').css('display','none');
                  $('#divbirth').css('display','none');
                  $('#divoldpass').css('display','none');
                  $('#divnewpass').css('display','none');
                  $('#divconfpass').css('display','none');
                  $('#divfile').css('display','none');
                  $('#card').css('display','none');
                  $('#button').css('display','none');
                  var f = document.getElementById("cambiamento")
                  f.className = "show";
                  setTimeout(function(){ f.className = f.className.replace("show", ""); }, 3000);
                }
              }
            });
          }
    }else{
      var pathfile = $("#path").val();
      var res = str.split("/");
      var dataString="path="+pathFile;
      $.ajax({
        url: "server-side/uploadFile.php",
        type: "POST",
        data: dataString,
        success: function(result){
          alert(result);
        }
      });
    }
}



</script>

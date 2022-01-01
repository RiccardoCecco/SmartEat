<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="width:80%;posiiton:absolute; text-align:center;">
  <div class="mdl-card__title" style="text-align:center;">
    <h2  class="mdl-card__title-text">New Account</h2>
  </div>
  <div class="mdl-card__supporting-text">
    <input type="text" id="name" name="name" placeholder="Name" required="required" />
    <input type="text" id="lastname" name="lastname" placeholder="Last Name" required="required" />
    <input type="text" id="username" name="username" placeholder="Username" required="required" />
    <input type="password" id="password" name="password" placeholder="Password" required="required" />
    <input type="number" id="privilegi" name="privilegi" placeholder="Privileges" required="required" />
    <input type="date" id="datanascita" name="datanascita" placeholder="Birthday" required="required" />
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="postData()">
      Add Account
    </a>
  </div>
</div>
<!--     <h1>New Account</h1>
    <form >
      <input type="number" id="matricola" name="matricola" placeholder="ID" required="required" />
      <input type="text" id="name" name="name" placeholder="Name" required="required" />
      <input type="text" id="lastname" name="lastname" placeholder="Last Name" required="required" />
      <input type="text" id="username" name="username" placeholder="Username" required="required" />
      <input type="password" id="password" name="password" placeholder="Password" required="required" />
      <input type="number" id="privilegi" name="privilegi" placeholder="Privileges" required="required" />
      <input type="date" id="datanascita" name="datanascita" placeholder="Birthday" required="required" />
      <button onclick="postData()" type="submit" class="btn btn-primary btn-block btn-large">Add account</button>
    </form>
-->
  <script type="text/javascript">
  function postData() {
    var name = $("#name").val();
    var lastname = $("#lastname").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var privilegi = $("#privilegi").val();
    var datanascita = $("#datanascita").val();
    var dataString= "username="+username+"&password="+password+"&name="+name+"&lastname="+lastname+"&privilegi="+privilegi+"&datanascita="+datanascita+"&operazione=1";
    $.ajax({
      url: "server-side/addAccount.php",
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
      url: "account.php",
      success: function(result){
        $("#content").empty();
        $("#content").append(result);
      }
  });
  }
  </script>

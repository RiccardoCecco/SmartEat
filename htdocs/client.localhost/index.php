<style type="text/css">
html, body {
  overflow-x: hidden;
}
</style>
<html>
<head >
  <!-- CORE CSS-->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/mystyle.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->
    <link href="css/custom/custom.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css"> -->

<!-- Compiled and minified JavaScript -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link rel="stylesheet" href="css/material.min.css">
    <script src="css/material.min.js"></script>


    <script type="text/javascript" src="js/jquery-3.0.0.js"></script>
    <script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>

    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.js"></script>

</head>
<?php
  $tavolo=$_GET["idTavolo"];
echo"<body onload='dropDB(".$tavolo.")'>";
 ?>

  <header id="header" class="page-topbar">
      <!-- start header nav-->
      <div class="navbar-fixed">
          <nav class="colour">
              <div class="nav-wrapper">
                  <ul >
                    <li class="left"><h1 class="logo-wrapper"><a href="" class="brand-logo darken-1"></a> <span>Smart Eat</span></h1></li>
                    <?php
                    $tavolo=$_GET["idTavolo"];
                      include_once "server-side/connection.php";
                      $conn=connessione();

                      $result = mysqli_query ($conn,'select * from ordine where idTavolo='.$tavolo);
                      $count=mysqli_num_rows($result);
                      if($count>=1){
                        echo "<li > <div style='position: absolute;right: 14%;align-items: center; padding-top:1%;width:auto;'><button onclick='viewOrder(".$tavolo.")' id='show-modal-example' type='button' class='mdl-button mdl-button--raised'><img src='icon/ic_shopping_cart_black_24px.svg' /></button></div><div style='position: absolute;right: 6%;align-items: center; padding-top:1%;width:auto;'><button  onclick='viewOrderFatto(".$tavolo.")' id='orderfatto' type='button' class='mdl-button mdl-button--raised'><img src='icon/ic_remove_red_eye_black_24px.svg' /></button></div> </li>";
                      }else{
                        echo "<li > <div style='position: absolute;right: 14%;align-items: center; padding-top:1%;width:auto;'><button onclick='viewOrder(".$tavolo.")' id='show-modal-example' type='button' class='mdl-button mdl-button--raised'><img src='icon/ic_shopping_cart_black_24px.svg' /></button></div><div style='position: absolute;right: 6%;align-items: center; padding-top:1%;width:auto;'><button style='display:none;' onclick='viewOrderFatto(".$tavolo.")' id='orderfatto' type='button' class='mdl-button mdl-button--raised'><img src='icon/ic_remove_red_eye_black_24px.svg' /></button></div> </li>";
                      }

                        //echo "<li style='position: absolute;right: 10%;align-items: center; padding-top:1%;width:auto;'><button onclick='view(".$tavolo.")' id='show-modal-example' type='button' class='mdl-button mdl-button--raised'><i class='material-icons'>shopping_cart</i></button></li>";

                        ?>
                  </ul>
                    <!--  <li class="carrello"><a class='btn-flat dropdown-button waves-effect waves-light white-text profile-btn' data-activates='profile-dropdown'><i style="align-items:center; position: absolute;" class="material-icons">shopping_cart</i></a>-->


                                <dialog style="width:60%;" id="modal-example">
                                    <div  id="content" class="mdl-dialog__content">
                                    </div>
                                    <div class="mdl-dialog__actions mdl-dialog__actions--full-width">
                                          <button type="button" class="mdl-button close"><img src='icon/ic_close_black_24px.svg' onclick=closedialog() /></button>
                                    </div>
                                </dialog>

                                <div id="food" > Add new foods into the order</div>



                                <script>
                                (function() {
                                      'use strict';
                                      var dialog = document.querySelector('#modal-example');
                                      var showButton = document.querySelector('#show-modal-example');
                                      if (!dialog.showModal) {
                                        dialogPolyfill.registerDialog(dialog);
                                      }
                                      var showClickHandler = function(event) {
                                        dialog.showModal();
                                      };
                                      showButton.addEventListener('click', showClickHandler);
                                    }());
                                    function closedialog(){
                                      var x = document.getElementById("modal-example");
                                      x.close();

                                      }
                                    </script>
                  <!--  <a class="carrello" onclick="newClientOrder()"><i class="material-icons">shopping_cart</i></a> -->
              </div>
          </nav>
      </div>
      <!-- end header nav-->
  </header>
  <section id='sectionContent'>

</section>



<script type="text/javascript">
var orders={};




function dropDB(tavolo){
  var dataString="idTavolo="+tavolo;

  $.ajax({
    url: "server-side/deleteDB.php",
    type: "POST",
    data:dataString,
    dataType: 'html',
    success: function(){
      page(tavolo);
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

function page(tavolo){
var dataString="idTavolo="+tavolo;
  $.ajax({
    url: "menu.php",
    type: "POST",
    data:dataString,
    dataType: 'html',
    success: function(result){
      $("#sectionContent").empty();
      $("#sectionContent").append(result);
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

function viewOrderFatto(tavolo){
  var dataString="idTavolo="+tavolo;

    $.ajax({
      url: "controlsOrder.php",
      type: "POST",
      data:dataString,
      dataType: 'html',
      success: function(result){
          $("#sectionContent").empty();
          $("#sectionContent").append(result);
      //    $("#profile-dropdown").empty();
      //    $("#profile-dropdown").append(result);
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

</script>
</body>
</html>

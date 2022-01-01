<?php
session_start();
include_once "server-side/connection.php";
$conn=connessione();
if($_SESSION['valid'] ==""){
  header('Location: index.php');
}
?>
<html>
<head>
  <!-- CORE CSS-->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->
    <link href="css/custom/custom.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/mystyle.css" type="text/css" rel="stylesheet" media="screen,projection">

<!-- Compiled and minified JavaScript -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="css/material.min.css">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">


    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>

    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>

    <link rel="stylesheet" href="css/material.min.css">
    <script src="css/material.min.js"></script>

</head>
<body >

  <script src="js/materialize.js"></script>

    <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div  class="navbar-fixed">
            <nav style="background-color: blue;">
                <div class="nav-wrapper">
                    <ul class="left">
                      <li><h1  class="logo-wrapper"><a class="brand-logo darken-1"></a> <span>Smart Eat</span></h1></li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
    </header>
    <div id="main">
      <div class="wrapper">
        <aside id="left-sidebar-nav">
                      <ul id="slide-out" class="side-nav fixed leftside-navigation ps-container ps-active-y" style="width: 240px;">
                      <li class="user-details cyan darken-2">
                      <div class="row">
                          <div class="col col s4 m4 l4">
                            <?php
                            $name=$_SESSION['username'];
                            if(file_exists("images/users/".$name.".jpg")){
                              $srcimage="images/users/".$name.".jpg";
                            echo "<img src='$srcimage' alt='' class='circle responsive-img valign profile-image'>";
                            }
                            elseif(file_exists("images/users/".$name.".png")){
                               $srcimage="images/users/".$name.".png";
                            echo "<img src='$srcimage' alt='' class='circle responsive-img valign profile-image'>";
                          }else {
                            echo "<img src='images/users/default-avatar.png' alt='' class='circle responsive-img valign profile-image'>";
                          }
                              //echo "<img src='images/users/'.$name.'.jpg' alt='' class='circle responsive-img valign profile-image'>";
                             ?>
                          </div>
                          <div class="col col s8 m8 l8">
                            <?php
                              echo "<a class='btn-flat dropdown-button waves-effect waves-light white-text profile-btn' data-activates='profile-dropdown'>".$_SESSION['username']."<i class='mdi-navigation-arrow-drop-down right'></i></a><ul id='profile-dropdown' class='dropdown-content'>";
                             ?>
                                  <li><!--<a href="server-side/logout.php"><i class="material-icons">input</i>Logout</a>-->
                                    <a href="server-side/logout.php"><img src='icon/ic_input_black_24px.svg' />Logout</a>
                                  </li>

                                  <li><!--<a onclick="show(4);"><i class="material-icons">settings</i> Settings</a>-->
                                    <a onclick="show(4);"><img src='icon/ic_settings_black_24px.svg' /> Settings</a>
                                  </li>
                              </ul>
                              <?php
                              $name=$_SESSION['username'];
                              $sql="SELECT * FROM users WHERE username='" .$name. "'";
                              $result=mysqli_query($conn,$sql) or die($name .mysql_error());
                              $value = $result->fetch_assoc();
                              //$value = mysqli_fetch_assoc($result);
                              if($result){
                                  if($value['privilegi'] == 1){
                                    echo "<p class='user-roal'>Administrator</p>";
                                  }else{
                                    echo "<p class='user-roal'>Operatore</p>";
                                  }
                                }
                            else {
                              echo 'ok3';
                            }
                               ?>
                          </div>
                      </div>
                      </li>
                      <!--<li class="bold active"><a onclick="show(1);" class="waves-effect waves-cyan"><i class="material-icons">query_builder</i> Orders</a>-->
                        <li class="bold active"><a onclick="show(1);" class="waves-effect waves-cyan"><img src='icon/ic_query_builder_black_24px.svg' /> Orders</a>

                      </li>
                      <!--<li id='accessAccount' class="bold active"><a  onclick="show(2);" class="waves-effect waves-cyan"><i class="material-icons">people</i> Account</a>-->
                      <li id='accessAccount' class="bold active"><a  onclick="show(2);" class="waves-effect waves-cyan"><img src='icon/ic_people_black_24px.svg' /> Account</a>
                      </li>
                      <!--<li class="bold active"><a  onclick="show(3);" class="waves-effect waves-cyan"><i class="material-icons">playlist_play</i> Menù</a>-->
                      <li class="bold active"><a  onclick="show(3);" class="waves-effect waves-cyan"><img src='icon/ic_playlist_play_black_24px.svg' /> Menù</a>
                      </li>
                      <li class="bold active"><a  onclick="show(5);" class="waves-effect waves-cyan"><img src='icon/ic_place_black_24px.svg' /> Tables</a>
                      </li>
                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 603px; right: 3px;"><div class="ps-scrollbar-y" style="top: 0px; height: 277px;"></div></div></ul>
                      <a  data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
      </aside>
      <?php

        $name=$_SESSION['username'];
        $sql="SELECT * FROM users WHERE username='$name'";
        $result=mysqli_query($conn,$sql);
        $value = $result->fetch_assoc();
        if($value['privilegi'] != 1){
        ?>
        <script type="text/javascript">$('#accessAccount').hide()</script>
        <?php
      }
      ?>
    </div>
    <section id="content">
                <div class="container">
                  <script type="text/javascript">
                  function show(id) {
                        if(id==1){
                          $.ajax({
                            url: "orders.php",
                            success: function(result){
                              $("#content").empty();
                              $("#content").append(result);
                            }
                        });
                      }else if (id==2) {
                        $.ajax({
                          url: "account.php",
                          success: function(result){
                            $("#content").empty();
                            $("#content").append(result);
                          }
                      });
                    }else if (id==3) {
                      $.ajax({
                        url: "menu.php",
                        success: function(result){
                          $("#content").empty();
                          $("#content").append(result);
                        }
                    });
                  }else if (id==4) {
                      $.ajax({
                        url: "accountsettings.php",
                        success: function(result){
                          $("#content").empty();
                          $("#content").append(result);
                        }
                    });
                    }
                    else if (id==5) {
                        $.ajax({
                          url: "table.php",
                          success: function(result){
                            $("#content").empty();
                            $("#content").append(result);
                          }
                      });
                      }
                }
                  </script>
                    <div id="content_box">
                        <div id="content_1" style="display: none;"><?php include 'account.php'; ?></div>
                    </div>
                </div>
    </section>

</body>
</html>

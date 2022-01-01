<?php
session_start();
include_once "server-side/connection.php";
$conn=connessione();
$_SESSION['valid'] = false;
$_SESSION['timeout'] = "";
$_SESSION['username'] = "";
?>
<html>
<head>
  <!-- CORE CSS-->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->
    <link href="css/custom/custom.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>



    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">


    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.js"></script>
</head>
<body>
  <script src="js/materialize.js"></script>

  <div class="login">
     <h1>Login</h1>
    <form action="server-side/checklogin.php"  method="post">
      <input type="text" id="username" name="username" placeholder="Username" required="required" />
        <input type="password" id="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Login</button>
    </form>
  </div>
</body>
</html>

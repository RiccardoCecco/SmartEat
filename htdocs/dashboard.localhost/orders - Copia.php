<div class="row">
  <div class="col s12 m6">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title">Underdevelopment :</span>
        <p>
          <ul>
            <?php
            session_start();
            include_once "server-side/connection.php";
            $conn=connessione();

            $result = mysqli_query ($conn,'select * from ordine');

            while($orders = mysqli_fetch_array($result)) {
              $paninoquery= mysqli_query($conn,"select *from panino where id='".$orders['idPanino']."'");
              while($panino= mysqli_fetch_array($paninoquery)){
              if($orders['stato']==0){
            //  echo "<li id='".$orders['id']."'>Tavolo n.'".$orders['idTavolo']."'  Nome Panino: '". $panino['nome']."' Quantita n. '".$orders['quantita']."'<a onclick='deleteOrder(".$orders['id'].")' class='waves-effect waves-light btn'><i class='material-icons'>delete</i></a></li>";
              echo "<li id='".$orders['id']."'>Tavolo n.'".$orders['idTavolo']."'  Nome Panino: '". $panino['nome']."' Quantita n. '".$orders['quantita']."'<a onclick='deleteOrder(".$orders['id'].")' class='waves-effect waves-light btn'><img src='icon/ic_delete_black_24px.svg'/></a></li>";

                }
              }
            }
            ?>

          </ul>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col s12 m6">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title">To do :</span>
        <p>
          <ul>
            <?php
            $result = mysqli_query ($conn,'select * from ordine');
            while($orders = mysqli_fetch_array($result)) {
              $paninoquery= mysqli_query($conn,"select *from panino where id='".$orders['idPanino']."'");
              while($panino= mysqli_fetch_array($paninoquery)){
              if($orders['stato']==1){
//              echo "<li id='".$orders['id']."'>Tavolo n.'".$orders['idTavolo']."'  Nome Panino: '". $panino['nome']."' Quantita n. '".$orders['quantita']."''<a onclick='changestato(".$orders['id'].")' class='waves-effect waves-light btn'><i class='material-icons'>add</i></a><a onclick='deleteOrder(".$orders['id'].")' class='waves-effect waves-light btn'><i class='material-icons'>delete</i></a></li>";
              echo "<li id='".$orders['id']."'>Tavolo n.'".$orders['idTavolo']."'  Nome Panino: '". $panino['nome']."' Quantita n. '".$orders['quantita']."''<a onclick='changestato(".$orders['id'].")' class='waves-effect waves-light btn'><img src='icon/ic_add_black_24px.svg'/></a><a onclick='deleteOrder(".$orders['id'].")' class='waves-effect waves-light btn'><img src='icon/ic_delete_black_24px.svg'/> </a></li>";

                }
              }
            }
            ?>
          </ul>
        </p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

function deleteOrder(id) {
  var dataString="id="+id+"&operation=1";
  $.ajax({
    url: "server-side/manageorders.php",
    type: "POST",
    data:dataString,
    dataType: 'html',
    success: function(result){
      $("#content").empty();
      $("#content").html(result);
    }
});
}

function changestato(id) {
  var dataString="id="+id+"&operation=2";
  $.ajax({
    url: "server-side/manageorders.php",
    type: "POST",
    data:dataString,
    dataType: 'html',
    success: function(result){
      $("#content").empty();
      $("#content").html(result);
    }
});
}
</script>

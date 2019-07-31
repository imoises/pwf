<?php 
require_once("./application/model/modelo_config_DB.php");?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<br><br>
<div class="fondo">
<br>
<br>
<br>
<div class="container">
  <div class="row">
    <br><br>
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s4"><a href="#test1" class="active">Pedidos sin tomar</a></li>
        <li class="tab col s4"><a  href="#test2">Pedidos en proceso</a></li>
        <li class="tab col s4"><a href="#test3">Pedidos realizados</a></li>
      </ul>
    </div>
    <div id="test1" class="col s12">
      <div class="section  lala">
        <table class="responsive-table centered">
          <?php      
          $conn = DataBase::conection();
          $sql = "select idPedido, tiempoPedido, UC.direccion DireccionCliente, precio, estadoPedido, c.direccion DireccionComercio, c.Ciudad CiudadComercio
          from pedido join usuario UC on pedido.idCliente = UC.idUsuario 
          join comercio C on pedido.idComercio = c.idComercio where estadoPedido='Pedido sin tomar'";
          echo '
          <thead>
          <tr class="jeje">
          <th>Numero Pedido</th>
          <th>Hora Pedido</th>
          <th>Dirección Cliente</th>
          <th>Precio</th>
          <th>Estado Pedido</th>
          <th></th>
          <th></th>
          </tr>
          </thead>'; 
          $result = mysqli_query($conn,$sql);
          while ($dataPedidos = mysqli_fetch_assoc($result)){
          $string = str_replace(' ', '%20',  $dataPedidos['DireccionCliente']);
          $string2 = str_replace(' ', '%20',  $dataPedidos['DireccionComercio']);
          $string3 = str_replace(' ', '%20', $dataPedidos['CiudadComercio']);
            echo'
            <tbody>
            <tr class="jeje">
            <td>'.$dataPedidos['idPedido'].'</td>
            <td>'.$dataPedidos['tiempoPedido'].'</td>
            <td>'.$dataPedidos['DireccionCliente'].'</td>
            <td>$'.$dataPedidos['precio'].'</td>
            <td class="red-text">'.$dataPedidos['estadoPedido'].'</td>
            <td><a href="/delivery/tomarPedidos?idPedido='.$dataPedidos['idPedido'].'"><i class="material-icons ja">
            check_circle_outline</i></a></td>
            <td><a target="_blank" href="https://www.google.com/maps/dir/'.$string2.','.$string3.'/'.$string.'">
            <i class="fas fa-map-marked-alt fa-lg blue-text text-darken-1 mapaicono"></i></a></td>
            </tr>
            </tbody>
            ' ; }
            ?>
          </table>
        </div>
      </div>
      <div id="test2" class="col s12">
        <div class="section  lala">
          <table class="responsive-table centered">
          <?php 
          $conn = DataBase::conection();
          $sql = "select idPedido, tiempoPedido, UC.direccion DireccionCliente, precio, estadoPedido, tiempoRecibo,
          c.direccion DireccionComercio, c.Ciudad CiudadComercio
          from pedido join usuario UC on pedido.idCliente = UC.idUsuario
          join comercio C on pedido.idComercio = c.idComercio 
          where estadoPedido='Pedido tomado' and idDelivery = ".$_SESSION['login']['idUsuario']."";
          echo '
          <thead>
          <tr class="jeje">
          <th>Numero Pedido</th>
          <th>Hora Pedido</th>
          <th>Hora Recibo</th>
          <th>Dirección Cliente</th>
          <th>Precio</th>
          <th>Estado Pedido</th>
          <th></th>
          <th></th>
          </tr>
          </thead>'; 
            $result = mysqli_query($conn,$sql);
            while ($dataPedidos = mysqli_fetch_assoc($result)){
              $string = str_replace(' ', '%20', $dataPedidos['DireccionCliente']);
              $string2 = str_replace(' ', '%20', $dataPedidos['DireccionComercio']);
              $string3 = str_replace(' ', '%20', $dataPedidos['CiudadComercio']);
              echo'
              <tbody>
              <tr class="jeje">
              <td>'.$dataPedidos['idPedido'].'</td>
              <td>'.$dataPedidos['tiempoPedido'].'</td>';
              if(!isset($dataPedidos['tiempoRecibo'])){
                echo '<td><a href="/delivery/reciboPedido?idPedido='.$dataPedidos['idPedido'].'"><i class="material-icons ja">directions_bike</i></a></td>';
              }else{
                echo '<td>'.$dataPedidos['tiempoRecibo'].'</td>';
              }
               echo '<td>'.$dataPedidos['DireccionCliente'].'</td>
              <td>$'.$dataPedidos['precio'].'</td>
              <td>'.$dataPedidos['estadoPedido'].'</td>';
              if(!isset($dataPedidos['tiempoRecibo'])){
                  echo '<td><i class="material-icons jaJA">
                  check_circle_outline</i></td>';
              }else{
                  echo '<td><a href="/delivery/pedidoRealizado?idPedido='.$dataPedidos['idPedido'].'"><i class="material-icons ja">
                  check_circle_outline</i></a></td>';
              }
              echo '<td><a target="_blank" href="https://www.google.com/maps/dir/'.$string2.','.$string3.'/'.$string.'">
              <i class="fas fa-map-marked-alt fa-lg blue-text text-darken-1 mapaicono"></i></a></td>
              </tr>
              </tbody>';}?>
            </table>
          </div>
        </div>
        <div id="test3" class="col s12">
          <div class="section  lala">
            <table class="responsive-table centered">
              <?php
              $conn = DataBase::conection();
              $sql = "select idPedido, tiempoPedido, UC.direccion DireccionCliente, precio, estadoPedido 
          from pedido join usuario UC on pedido.idCliente = UC.idUsuario where estadoPedido='Realizado' and idDelivery = ".$_SESSION['login']['idUsuario'].";";  
              echo'
                <thead>
                <tr class="jeje">
                <th>Numero Pedido</th>
                <th>Hora Pedido</th>
                <th>Dirección Cliente</th>
                <th>Precio</th>
                <th>Estado Pedido</th>
                </tr>
                </thead>';
              $result = mysqli_query($conn,$sql);
              while ($dataPedidos = mysqli_fetch_assoc($result)){
                echo'
                <tbody>
                <tr class="jeje">
                <td>'.$dataPedidos['idPedido'].'</td>
                <td>'.$dataPedidos['tiempoPedido'].'</td>
                <td>'.$dataPedidos['DireccionCliente'].'</td>
                <td>$'.$dataPedidos['precio'].'</td>
                <td class="green-text">'.$dataPedidos['estadoPedido'].'</td>
                </tr>
                </tbody>';}
                ?>
              </table>
              </div>
            </div>
          </div>
          </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<style>
.fondo{
  background-image: url("../application/resources/img/fondito2.jpg");
  height: 100%;
  background-repeat: repeat;
  margin-top: -45px;
}
.lala{
  background-color: white;
}
.iconito{
  color: green;
}
.tabs .tab a{
      /* color:orange; */
      background-color: white;
}
.tabs .tab a:hover {
      background-color: white;
      color: #e65100;
} /*Text color on hover*/
.tabs .tab a.active {
      background-color: white;
      color: #e65100;
} /*Background and text color when a tab is active*/
.tabs .indicator {
      background-color: #e65100;
} 
.jeje{
  color: #e65100;
}
.ja{
  color: green;
  font-size: 34px;
}
.jaJA{
  color: red;
  font-size: 34px;
}
.mapaicono{
  font-size: 34px;
}
</style>
<?php
if($data === false){
	echo "<script type='text/javascript'>alert('Solo puede tomar un pedido a la vez.');</script>";
}
?>
<div class="fondo">
 <div class="section container "> <br><br>
  <div class="row f">
<?php  
   echo'<table class="highlight striped responsive-table centered xd">
        <thead>
        <tr class="orange-text text-darken-4">
        <th>Nº Pedido</th>
        <th>Hora Pedido</th>
        <th>Tiempo Recibido</th>
        <th>Estado Pedido</th>
        <th>Cliente</th>
        <th>Delivery</th>
        <th>Precio</th>
        <th>Detalles</th>
        </tr>
        </thead>';
        if(isset($data['pedido'])){
        foreach($data['pedido'] as $key=>$item){
        if(!is_null($item)){
		$string = str_replace(' ', '%20', $item->DireccionCliente);
		$string2 = str_replace(' ', '%20', $item->DireccionComercio);
		$string3 = str_replace(' ', '%20', $item->CiudadComercio);
        echo '<tbody>
                <tr>
                <td>'.$item->idPedido.'</td>
                <td>'.$item->tiempoPedido.'</td>';
                if(!empty($item->tiempoRecibo)){
                echo '<td>'.$item->tiempoRecibo.'</td>';
                }else{
                echo '<td>-</td>';
                }
                echo '
                <td>'.$item->estadoPedido.'</td>
                <td>'.$item->NombreCliente.'</td>';
                if(!empty($item->NombreDelivery)){   
                echo "<td>".$item->NombreDelivery."</td>";}
                else{
                echo "<td>-</td>";
                }
                echo '<td>$'.$item->precio.'</td>
                <td><a class="waves-effect waves-light btn modal-trigger orange darken-4" href="/#modal'.$item->idPedido.'">Detalles</a></td>
                <div id="#modal'.$item->idPedido.'" class="modal">
                  <div class="modal-content">
                    <h3 class="orange-text text-darken-3 center-align">Lista de items pedidos</h3>';
                switch($_SESSION['login']['rol']){
                case 'op-comercio':
                echo'<form action="/comercio/confirmarPedido" METHOD="POST">';
                break;
                case 'cliente':
                echo'<form action="/cliente/cancelarPedido" METHOD="POST">';
                break;
                }
                if(isset($data['pedido2'])){
                  foreach($data['pedido2'] as $key=>$item2){
                  if(!is_null($item2)){
                  if($item2->idPedido === $item->idPedido){
                    echo '<div class="row center-align">
                    <div class="col s3">
                    <img height="75" width="100" src="'.$item2->Foto.'">
                    </div>
                    <div class="col s3">
                    <h5>'.$item2->NombreItem.'</h5>
                    </div>
                    <div class="col s3">
                    <h5>$'.$item2->PrecioUnitario.'</h5>
                    </div>
                    <div class="col s3">
                    <h5>Cantidad: '.$item2->Cantidad.'</h5>
                    </div>
                    </div>';

                  }
                    }
                  }
                }
              if($item->estadoPedido == 'A confirmar' && $_SESSION['login']['rol'] == 'op-comercio' || $item->estadoPedido != 'Realizado' && $_SESSION['login']['rol'] == 'cliente'){
              echo '
              <div class="row">
              <div class="col s2 offset-s2">
              <button class="btn-large red darken-4 center-align" name="pedido" value='.$item->idPedido.'type="submit">Rechazar</button>
              </div>';
              }
              if($item->estadoPedido == 'A confirmar'
              && $_SESSION['login']['rol'] == 'op-comercio'){
              echo '
              <div class="col s2 offset-s4">
              <button class="btn-large green darken-4 center-align" name="pedido" value='.$item->idPedido.'type="submit">Aceptar</button>
              </div></div>';
              
              }
					
					echo'<div class="row"><div class="col s3 offset-s5"><a target="_blank" class="btn-large orange darken-4 center-align" href="https://www.google.com/maps/dir/'.$string2.','.$string3.'/'.$string.'">Ver lugar</a>
            </div>
            </div>
            </tr>
            </tbody>
            ';
   }   
 }
}
?>
</table>

</div>
</div>
</div>
<script>
$(document).ready(function(){
    $('.modal').modal();
  })
</script>
<style>
.f{
    background:rgba(0,0,0,0.6);
}
*{
  box-sizing: border-box;
}
</style>

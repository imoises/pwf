<div class="fondo">
<div class="container section fonditoContainer">
<h1 class="center-align orange-text text-darken-3">Resúmenes</h1><br>
<h5 class="center-align black-text">Por favor, elija las fechas en la que quiera ver el historial de sus resúmenes.</h5><br><br><br>

<form  action="/Resumen/traerResumen" method="POST">
    <div class="row center-align">
  <div class="col s3 offset-s2 center-align">
    <select name="mes" class="orange-text">
      <option value="" disabled selected>Elegir Mes</option>
      <option value="1" >Enero</option>
      <option value="2">Febrero</option>
      <option value="3">Marzo</option>
      <option value="4">Abril</option>
      <option value="5">Mayo</option>
      <option value="6">Junio</option>
      <option value="7">Julio</option>
      <option value="8">Agosto</option>
      <option value="9">Septiembre</option>
      <option value="10">Octubre</option>
      <option value="11">Noviembre</option>
      <option value="12">Diciembre</option>
    </select>
    <label>Mes</label>
  </div>

    <div class="col s3 offset-s2 center-align">
    <select name="año">
        <option value="" disabled>Elegir Año</option> 
        <option value="2018" selected>2018</option>
        <option value="2019">2019</option>
        <option value="2020">2020</option>
    </select>
    <label>Año</label>
    </div>    

    <br><br><br><br><br><br>
    <div class="row">
    <div class="col s12 center-align">
    <button class="btn waves-effect waves-light orange darken-3" type="submit" name="action">Confirmar
    <i class="material-icons right">send</i>
    </button>
    </div>
    </div>
    </form>

    </div>   

<?php
if(isset($data['datos1'])){  
    foreach($data['datos1'] as $key=>$datos){
        if(!is_null($datos)){
            $delivery = ($datos->PrecioTotal*3)/100;
            $app = ($datos->PrecioTotal*5)/100;
            echo'

            <table class="highlight centered responsive-table">
            <thead>
              <tr class="orange-text text-darken-3">
                  <th>Productos Vendidos</th>
                  <th>Fondos Totales</th>
                  <th>Gastos en Deliverys</th>
                  <th>Comisión APP</th>
                  <th>Ganancias</th>
              </tr>
            </thead>
            <tbody>
              <tr>';
              if($datos->Cantidad != 0){
              echo'<td>'.$datos->Cantidad.' unidades</td>';}
              else{
              echo'<td>Ninguna unidad vendida</td>';
                }
                if(isset($data['datos2'])){  
                  foreach($data['datos2'] as $key=>$datos){
                    if(!is_null($datos)){
                    $delivery = ($datos->Total*3)/100;
                    $app = ($datos->Total*5)/100;
                    $ganancias = $datos->Total - $app - $delivery;
                    if($datos->Total != 0){
                    echo'<td>$'.$datos->Total.'</td>';}
                    else{ echo '<td>$0</td>';}
                    echo'<td>$'.$delivery.'</td>
                    <td>$'.$app.'</td>
                    <td>$'.$ganancias.'</td>';}}}
                    echo'
                  </tr>
                </tbody>
              </table>';
    }
}
} 
?>
</div>
</div>
<style>
.fondo{ 
    background-image: url("../application/resources/img/fondito4.jpg");
    background-repeat: repeat;
    background-position: center;
}
.fonditoContainer{
  background: white;
}
</style>

<?php 
  	if (isset($data)){
  		$comercios = array();
  		foreach ($data as $key => $comercio) {
  			$prepComers = array('idComercio' => $comercio->idComercio,'mes' => $comercio->mes,'anio' => $comercio->anio);
  			array_push($comercios,$prepComers);
  		}
  	}
?>


<div class='container center'>
	<h1 class='text-center'>LIQUIDACION A COMERCIOS</h1>
</div><br>

<div class="contenedorFiltro">
	<form  action="/admin/liquidarComercio" method="POST">
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
				    <button class="btn waves-effect waves-light orange darken-3" type="submit" name="action">Aceptar
				    </button>
			    </div>
		    </div>
	    </div>
    </form>
</div><br><br>


<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    <?php
    	  if (!isset($data)) { echo "Para listar Comercios Seleccione el mes a liquidar";}
    	  else{echo "Lista Comercios a Liquidar
    	  			<form  action='/admin/realizarLiquidacionComercios' method='POST'>
    	  				<input type='hidden' name='comercios' value='".serialize($comercios)."'>
    	  				<button type='submit' class='btn btn-warning' id='btnLiquidar'>Liquidar todos</button>
    	  			</form>";
    	  }
    ?>
    
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Comercio</th>
            <th>Cantidad de ventas</th>
            <th>Recaudacion</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Comercio</th>
            <th>Cantidad de ventas</th>
            <th>Recaudacion</th>
          </tr>
        </tfoot>
        <tbody>
          
        	<?php 
	          	if (isset($data)){
	          		foreach ($data as $key => $comercio) {
		                echo "<tr>
		                        <td>".$comercio->idComercio."</td>
		                        <td>".$comercio->razonSocial."</td>
		                        <td>".$comercio->cantVentas."</td>
		                        <td>".$comercio->recaudacion." "."$</td>
		                      </tr>";             
	            	}

	          	}
        	?>
          
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">Updated</div>
</div>

<style>
	.contenedorFiltro{
		width: 50%;
		margin: 0 auto;
	}
	#btnLiquidar{
		display: block;
		float: right;
	}
</style>
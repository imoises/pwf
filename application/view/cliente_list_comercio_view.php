<div class="container">
	<br><br>
	<h3 class="center orange-text text-darken-3">Busca Restaurantes de tu <b>ciudad</b></h3>
	<br><br>
	<form action="/restaurant/restaurantes" method="POST">
		<div class="row">
			<div class="input-field col s4 offset-s3 z-depth-6" id="buscadorListProduct">
				<select class="white-text" name="ciudad">
                    <option value="" selected class="white-text">Ciudad</option>
                    <?php
                        foreach ($_SESSION['ciudades'] as $key => $ciudad) {
                            echo "<option value='".$ciudad->ciudad."' class='white-text'>".$ciudad->ciudad."</option>";
                        }
                    ?>
                </select>
			</div>
			<div class="input-field col s3 z-depth-6 transparent center-align" id="buscadorListProduct">
				<button class="waves-effect  waves-light btn-large orange darken-3" type="submit" name="action">Buscar</button>
			</div>
		</div>
	</form>
	<br><br>
	<div class="orange-text center-align"><?php echo "<h4>   Restaurantes de <b>".$data['0']->ciudad."</b></h4>"; ?></div><br>
	<br><br>    
	<div class="row">
      <div class="col s12">
		<?php
			foreach($data as $key=>$comercio){
				if(!is_null($comercio)){
					echo "<div class='col s12 m6 l4'>                    
				            <div class='card z-depth-3'>
				              <div class='card-image' id='carta'>
				                  <img src='".$comercio->fotoBanner."' class=''  height='100' width='100' alt='img1'>
				              <div class='card-content'>
				              <form action='/product/buscarProducto' method='POST'>
				              	<input name='idComercio' type='hidden' value='".$comercio->idComercio."'>
								<select class='white-text' name='categoria' id='categoria'>
								<option value=1>Todos los productos</option>
								<option value=2>En oferta</option>
								<option value=3>Sin oferta</option>
							</select>
				                <button type='submit' name='btn' class='btn-small orange darken-3'>Ver</button>
				               </form>
				              </div>
							  </div>
				            </div>
				          </div>";
				}
			}
		?>
		
      </div>
	</div>
</div><br><br>
<style>
</style>


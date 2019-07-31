<?php 
if(!is_null($data["fotoBanner"])){
echo '<img id="baner" src='.$data["fotoBanner"].'>';
}else{
	echo '<img id="baner" src="../application/resources/img/bannerdefault.jpg">';
}?>
<div class="fondo"><br><br>
	<div class="section container lala">
		<div class="row">
			<h3 class="center orange-text text-darken-4 flow-text productos">Productos de <?php echo isset($data['razonSocial']) ? "<b>".$data['razonSocial']."</b>": "<b>McDonalds</b>"; ?></h3>
			<div class="section">
				<form action="/restaurant/restaurantes" method="POST">
					<div class="row">
						<div class="col s4 container"></div>
						<div class="input-field col s4 z-depth-6" id="buscadorListProduct">
							<select class="white-text" name="ciudad" id="nombreCiudad">
			                    <option value="<?php echo isset($data['ciudad']) ? $data['ciudad']: 'San Justo'; ?>" selected class="white-text"><?php echo isset($data['ciudad']) ? $data['ciudad']: 'San Justo'; ?></option>
			                    <?php
			                        foreach ($_SESSION['ciudades'] as $key => $ciudad) {
			                            echo "<option value='".$ciudad->ciudad."' class='white-text'>".$ciudad->ciudad."</option>";
			                        }
			                    ?>
			                </select>
						</div>
						<div class="input-field col s1 z-depth-6 transparent center-align" id="buscadorListProduct">
							<a class="btn modal-trigger orange darken-3 btn-small" href='#buscar'>
								<button class="btn-flat white-text" type="submit" name="action" onclick="pasarValor()">Buscar</button>
							</a>
						</div>
					</div>
				</form>
			</div>
			<?php if (isset($_SESSION['carrito'])) {
				echo "<div id='buscar' class='modal'>

					    <div class='modal-content'>
					      <h4>Buscar restaurant</h4><br>
					      <h5>Perdera los productos que agrego al carrito</h5><br><br>
					      	<form action='/restaurant/restaurantes' class='col s12' METHOD='POST'>
						      <div class='row'>
						      <div class='col s1 offset-s5'>
								<div id='tranferNombreCiudad'></div>
								<button class='btn-large orange darken-4' type='submit'>Continuar</button>
					          </div>
						      </div>
							</form>  
					  </div>
					</div>";
			} ?>

			<?php
			if(empty($data['item'])){
				echo "<h3 class='center orange-text text-darken-4 flow-text productos'>Parece no tiene productos en esta categoria.";
			}
			else{
			foreach($data['item'] as $key=>$item){
				if(!is_null($item)){
					$stock = "Sin Stock";
					$color = "red-text";
					if ($item->stock > 0) {
						$stock = "Con Stock";
						$color = "green-text";
					}	
					echo "<div class='section'>
					<div class='col s12'>
					<div class='card horizontal'>
					<div class='col s3'>
					<div class='card-imagee'>";
					if($item->oferta == true){
					echo "<i class='material-icons onsale'>local_offer</i>";}
					echo " <img src='".$item->foto."' width='100%' height='200px'>
					</div>
					</div>
					<div class='col s6'>
					<h5 class='orange-text text-darken-2' size='14px'>".$item->nombre."</h5>
					<p>".$item->descripcion."</p>
					<form action='/cliente/agregarAlCarrito' method='POST'>
					<input type='hidden' name='comercio' value='$item->idComercio'>
					<input type='hidden' name='nombre' value='$item->nombre'>
					<p><span class='".$color."'>".$stock."</span>
					<input type='number' name='cantidad' size='1' data-length='1' min=1 value='1'> 
					<span> Precio: $".$item->precio."</span></p>
					</div>
					<div class='col s3 orange-text'><br><br>
					<button id='boton' onclick='toast()' class='waves-effect waves-light btn-large orange darken-3' type='submit' name='submit'>
					Pedir</button>
					</form>
					</div>
					</div>
					</div>
					</div>";
				}
			}
		}
			?>
</div>
</div><br><br>
</div>
<script>
function toast(){
	var toastHTML = '<span>Agregado al carrito!</span>';
  		M.toast({html: toastHTML,	
				displayLength: 3000
		  });
}
</script>
</div>

<style>
.fondo{
	background-image: url("../application/resources/img/fondito4.jpg");
	height: 100%;
	background-repeat: repeat;
	/* background-size: cover;
	position: relative; */
	margin-top: -45px;
}
.lala{
	background-color: white;
}
.character-counter{
	font-size: 0px !important;
}
#inputComercio{
	display: block;
	margin-top: 14px;
}

#boton{
	margin-top: 40px;
	margin-left: 25px;
}

.productos{
	font-size: 55px;
}
#baner{
	height: 300px;
	width: 100%;
}
.onsale{
	margin-bottom: 45px;
	position: absolute;
	color: red;
	font-size: 50px;
}
</style>

<script>
	function pasarValor(){
		var nombreCiudad = $("#nombreCiudad").val();
		var html = "<input type='hidden' name='ciudad' value='";
		html+=nombreCiudad;
		html+="'>";
		$("#tranferNombreCiudad").html(html);
	}

	$(document).ready(function(){
	    $('.modal').modal();
	});

    $(function() {
        $("#ciudad").change(function() {
            var ciudad = $(this).val();
            var parametro = 'ciudad='+ ciudad;

            $.ajax ({
                type: "GET",
                url: "../application/ajax/comercios_ajax.php",
                data: parametro,
                cache: false,
                success:
                    function(html){
                        $("#contenSelectComer").html(html);
                    }
            });
        }).trigger("change");
    });
</script>

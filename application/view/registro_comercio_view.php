
<br><br>

<div class="section container center-align z-depth-5" id="p1">

<!-- usuario- email- pass- nombre- apellido- rol- direccion- telefono- idcomercio -->

  <div class="row">
    <form class="col s12" method="POST" action="/registro/registrarComercio" ENCTYPE="multipart/form-data">
		<div class="row">
		<div class="col s2 offset-s5 center-align orange darken-3  z-depth-5" id="asdasd">
		
		</div>
		</div>
        <div class="row">
        <div class="input-field col s6">
            <input id="email" type="email" name="email" class="validate white-text">
            <label for="email">Email</label>
        </div>

        <!--div class="input-field col s6">
            <input id="pass" type="password" name="password" class="validate white-text">
            <label for="pass">Contraseña</label>
        </div-->
	    <br>
            <div class="input-field col s6">
                <input id="fotoBanner" TYPE="file" name="fotoBanner" class="validate white-text">
                Foto Banner
            </div>
        </div>
        
	    <div class="row">
		    <div class="input-field col s6">
	          <input id="razonSocial" type="text" name="razonSocial" class="validate white-text">
	          <label for="razonSocial">Nombre del comercio</label>
	        </div>

	        <div class="input-field col s6">
	          <input id="ciudad" type="text" name="ciudad" class="validate white-text">
	          <label for="ciudad">Ciudad</label>
	        </div>
        </div>

        <div class="row">
	        <div class="input-field col s6" id="mostrar_cliente">
	            <input id="direccion" type="text" name="direccion" class="validate white-text">
	            <label for="direccion">Dirección</label>
	        </div>

	        <div class="input-field col s6">
	        	<select name="tiempoEntrega" class="validate white-text">
	        		<option value="10" selected>10 minutos</option>
	        		<option value="15">15 minutos</option>
	        		<option value="20">20 minutos</option>
	        		<option value="25">25 minutos</option>
	        		<option value="30">30 minutos</option>
	        		<option value="35">35 minutos</option>
	        		<option value="40">40 minutos</option>
	        	</select>
	        	<label for="telefono">Tiempo estimado de entrega</label>
	        </div>
        </div>    

        <div class="row">
        <div class="col s6 offset-s4 left-align">
        <button class="waves-effect waves-light btn-large orange darken-4" type="submit" name="btnRegistComercio" onclick="mensaje()">Registrar Comercio</button> 
        </div>

    </div>
    </form>
    </div>


</div>

<style>
#p1{
    background-color:rgba(0,0,0,0.8);
    width:50%;
    padding:4px;
    /* margin: auto; */
    }
#xd{
    margin-top:30px;
}
#asdasd{
    /* background-color:rgba(230,81,0,.5); */
    /* background-color: orange; */
    margin-top: 25px;
}
</style>


<script>
function mensaje(){
    alert('Gracias por registrar su comercio, en breve le confirmaremos sobre el estado a su email.');
}

$(document).ready(function () {
    toggleFields(); // call this first so we start out with the correct visibility depending on the selected form values
    // this will call our toggleFields function every time the selection value of our other field changes
    $("#rol").change(function () {
        toggleFields();
    });

});
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });
</script>
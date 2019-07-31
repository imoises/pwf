<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->

       <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--Animate-->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
       <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>‌​

    </head>

<body>

<div class="section container center-align z-depth-5" id="p1">

<!-- usuario- email- pass- nombre- apellido- rol- direccion- telefono- idcomercio -->

  <div class="row">
    <form class="col s12" method="POST" action="/registro/registrarUsuario">
		<div class="row">
		<div class="col s2 offset-s5 center-align orange darken-3  z-depth-5" id="asdasd">
		<select id="rol" name="rol">
		  <option class="white-text" value="" selected="selected" disabled="disabled">Elegir Rol</option>
				<option value="cliente" class="white-text">Cliente</option>
				<option value="delivery" class="white-text">Delivery</option>
				<!--option value="op-comercio" class="white-text">Op. Comercio</option-->    
				<!-- <option value="usuario">Usuario</option>   -->
		</select>
		</div>
		</div>
        <div class="row">
        <div class="input-field col s6">
            <input id="email" type="email" name="email" class="validate white-text" required>
            <label for="email">Email</label>
        </div>

        <div class="input-field col s6">
            <input id="pass" type="password" name="password" class="validate white-text" required>
            <label for="pass">Contraseña</label>
        </div>
        </div>    


      <div class="row">
      <div class="input-field col s6">
          <input id="nombre" type="text" name="nombre" class="validate white-text" required>
          <label for="nombre">Nombre</label>
        </div>

        <div class="input-field col s6">
          <input id="apellido" type="text" name="apellido" class="validate white-text" required>
          <label for="apellido">Apellido</label>
        </div>
        </div>

        <div class="row">
        <div class="input-field col s6" id="mostrar_cliente">
            <input id="direccion" type="text" name="direccion" class="validate white-text">
            <label for="direccion">Dirección</label>
        </div>


        <div class="input-field col s6" id="mostrar_comercio">
            <input id="mostrar_comercio" type="number" name="idComercio" class="validate white-text">
            <label for="comercio_id">Id comercio</label>
        </div>

        <div class="input-field col s6">
            <input id="telefono" type="tel" name="telefono" class="validate white-text" required>
            <label for="telefono">Teléfono</label>
        </div>


        
        </div>    

        <div class="row">
        <div class="col s6 offset-s5 left-align">
        <button class="waves-effect waves-light btn-large orange darken-4" type="submit" name="submit">Registrarse</button> 
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
$(document).ready(function () {
    toggleFields(); // call this first so we start out with the correct visibility depending on the selected form values
    // this will call our toggleFields function every time the selection value of our other field changes
    $("#rol").change(function () {
        toggleFields();
    });

});
</script>

<script>
// this toggles the visibility of other server
function toggleFields() {
if ($("#rol").val() === "cliente")
        $("#mostrar_cliente").show();

else
        $("#mostrar_cliente").hide();


if ($("#rol").val() === "op-comercio")
        $("#mostrar_comercio").show();      
else
$("#mostrar_comercio").hide();          

}
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
  });
  </script>
  </body>


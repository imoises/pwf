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
<br><br><br>
  <div class="row">
    <form class="col s12" method="POST" action="/modificarPerfil/modificarUser">
        <div class="row">
        <div class="input-field col s6">
		<?php
            echo '<input id="email" type="email" name="email" class="validate white-text" value='.$_SESSION['login']['email'].'>';?>
            <label for="email">Email</label>
        </div>

        <div class="input-field col s6">
		<?php
            echo '<input id="pass" type="password" name="password" class="validate white-text"'>';?>
            <label for="pass">Contraseña</label>
        </div>
        </div>    


      <div class="row">
      <div class="input-field col s6">
		<?php
          echo '<input id="nombre" type="text" name="nombre" class="validate white-text" value='.$data["nombre"].'>'?>
          <label for="nombre">Nombre</label>
        </div>

        <div class="input-field col s6">
		<?php
          echo '<input id="apellido" type="text" name="apellido" class="validate white-text" value='.$data["apellido"].'>'?>
          <label for="apellido">Apellido</label>
		</div>
        </div>
		<?php
		if($_SESSION['login']['rol'] == 'cliente'){?>
        <div class="row">
        <div class="input-field col s6" id="mostrar_cliente">
		<?php
          echo '<input id="direccion" type="text" name="direccion" class="validate white-text" value="'.$data["direccion"].'">
            <label for="direccion">Dirección</label>
        </div>';
		 } ?>
        <div class="input-field col s6">
		<?php
          echo '<input id="telefono" type="tel" name="telefono" class="validate white-text" value='.$data["telefono"].'>'?>
            <label for="telefono">Teléfono</label>
        </div>

        </div>    

        <div class="row">
        <div class="col s6 offset-s5 left-align">
        <button class="waves-effect waves-light btn-large orange darken-4" type="submit" name="submit">Actualizar</button> 
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
    background-color:rgba(230,81,0,.5);
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
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
  });
  </script>
  </body>
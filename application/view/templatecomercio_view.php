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

    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    

    </head>

    <body>

    

    <nav class="orange darken-3">
      <div class="nav-wrapper container orange darken-3">
        <a href="/" class="brand-logo"><i class="fas fa-utensils"></i>Pedidos Now</a>
        <ul class="right hide-on-med-and-down">
        <?php if (isset($_SESSION['login']['rol'])){
              echo '<li><a href="/Pedido">Pedidos</a></li>';
              }
            ?>
      <li><a href="/main/nosotros">Nosotros</a></li>
      <?php
          if(isset($_SESSION['login']['rol'])){

          if ($_SESSION['login']['rol'] == "op-comercio") {
          echo'   <li><a href="/Resumen">Resumen</a></li> ';}
            
          if($_SESSION['login']['rol'] == "delivery"){
            echo '<li><a href="/ResumenDelivery">Resumen</a></li>';
          }}

          if(isset($_SESSION['login']['rol'])){

            if ($_SESSION['login']['rol'] == "cliente") {
                echo "
                      <li class='orange darken-4 center'><a class='dropdown-trigger center-align' href='#!' data-target='dropdown1'>".
                      $_SESSION['login']['nombre']."
                      <i class='material-icons right'>arrow_drop_down</i></a></li>
                      <li><a href='/cliente/agregadosacarrito'><i class='large material-icons'>shopping_cart</i></a></li>
                      </ul>" ;
            }else{
                  echo"
                  <li class='orange darken-4 center'><a class='dropdown-trigger center-align' href='#!' data-target='dropdown1'>".
                  $_SESSION['login']['nombre']."
                  <i class='material-icons right'>arrow_drop_down</i></a></li>
                  </ul>" ;
            }
          }else{
            echo '<li id="iniciar" class="orange darken-4"><a href="/login">Iniciar sesión</a></li>';}
      ?>
      </div>      
    </nav>

    <ul id="dropdown1" class="dropdown-content">
    <li><a href="/modificarPerfil">Cambiar datos</a></li>
    <li class="divider"></li>
    <li><a href="/login/cerrarSesion">Cerrar sesión</a></li>
    </ul>
 
    <?php include 'application/view/'.$content_view; ?>

<style>
#buscador{
      margin-top: 250px;
      background: white;
      text-decoration: none;
      margin-left: 2px;
      border-color: grey;
} 
.parallax-container {
      height: 670px;
      width: 100%;
    }
.espacio{
  padding-top: 5px;
}
.espacio2{
  padding-top: 10px;
}
*{
  box-sizing: border-box;
}
.dropdown-content li>span {
  color: #e65100 !important;
}

.dropdown-content li>a {
  color: #e65100 !important;
}

.select-content li>span {
  color: #e65100 !important;
}

.select-content li>a {
  color: #e65100 !important;
}
.asdasd{
  bottom: 100%;
}
</style>


        <footer class="page-footer orange darken-4 asdasd">
          <div class="container">
            <div class="row">
              <div class="col s4">
                <h5 class="white-text">Pedidos Now</h5>
                <p class="grey-text text-lighten-4"></p>
              </div>
              <div class="col s4 center">
                <h5 class="white-text">Contacto</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!"><i class="fab fa-facebook fa-2x espacio"></i></a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><i class="fab fa-instagram fa-2x espacio"></i></a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><i class="fab fa-twitter fa-2x espacio"></i></a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><i class="fab fa-youtube fa-2x espacio"></i></a></li>
                </ul>
              </div>
              <div class="col s4">
                <h5 class="white-text center">Trabajar con nosotros</h5>
                <ul class="center">
                  <li class="espacio2"><a class="grey-text text-lighten-3" href="#!"><h6>Restaurant</h6></a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><h6>Delivery</h6></a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><h6>Comercio</h6></a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><h6>Nosotros</h6></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2018 Copyright UNLaM
           <!-- <a class="grey-text text-lighten-4 right" href="#!">More Links</a> -->
            </div>
          </div>
        </footer>
      <!--JavaScript at end of body for optimized loading-->

       <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

       <script>
          document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.parallax');
          var instances = M.Parallax.init(elems);

           var elems = document.querySelectorAll('select');
           var instances = M.FormSelect.init(elems);

           var elems = document.querySelectorAll('.sidenav');
           var instances = M.Sidenav.init(elems);

           var elems = document.querySelectorAll('.dropdown-trigger');
           var instances = M.Dropdown.init(elems);

           var elems = document.querySelectorAll('.materialboxed');
           var instances = M.Materialbox.init(elems);

           var elems = document.querySelectorAll('.modal');
           var instances = M.Modal.init(elems);
          });
        </script>
    </body>
  </html>
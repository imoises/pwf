<!-- Vista para listar los comercios pendientes a haprobar -->

<?php
  if ($data!="vacio" ) {
    echo "<div class='container center'>
      <h1 class='text-center'>HABILITAR COMERCIOS</h1>
    </div>";
  }
?>

<div class='row'>
        <?php
          if ($data!="vacio" ) {
            foreach($data as $key=>$comercio){
              if(!is_null($comercio)){
                echo "
                        <div class='col-xl-3 col-sm-6 mb-3'>
                          <div class='card text-black bg-light o-hidden h-100'>
                            <div class='card-body'>
                              <div class='card'>
                                <div class='card-body'>
                                  <img class='card-img-top' src='".$comercio->fotoBanner."' alt='Card image cap'>
                                </div>
                                <div class='card-header'>".$comercio->razonSocial."</div>
                                <ul class='list-group list-group-flush'>
                                  <li class='list-group-item'>Ciudad: ".$comercio->ciudad."</li>
                                  <li class='list-group-item'>Email: ".$comercio->email."</li>
                                  <li class='list-group-item'>Tiempo de entrega: ".$comercio->tiempoEntrega." min</li>
                                </ul>
                                <div class='card-body'>
                                <form action='/admin/habilitarComercio' method='POST'><button type='submit' name='idComercio' value='".$comercio->idComercio."' class='btn btn-primary'>HABILITAR</button></form>
                                <form action='/admin/eliminarComercio' method='POST'><button type='submit' name='idComercio' value='".$comercio->idComercio."' class='btn btn-danger'>ELIMINAR</button></form>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>";
              }
            }
          }else{
            echo "<div class='container center'>
                    <h1 class='text-center'>No hay comercios pendientes a habilitar</h1>
                  </div>";
          }

        ?>
</div>

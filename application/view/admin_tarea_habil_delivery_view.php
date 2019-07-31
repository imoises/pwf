
<?php
  if ($data!="vacio" ) {
    echo "<div class='container center'>
      <h1 class='text-center'>HABILITAR DELIVERY</h1>
    </div>";
  }
?>

<div class='row'>
        <?php
          if ($data!="vacio" ) {
            foreach($data as $key=>$delivery){
              if(!is_null($delivery)){
                echo "
                        <div class='col-xl-3 col-sm-6 mb-3'>
                          <div class='card text-black bg-light o-hidden h-100'>
                            <div class='card-body'>
                              <div class='card'>
                                <div class='card-header'>".$delivery->nombre." ".$delivery->apellido."</div>
                                <ul class='list-group list-group-flush'>
                                  <li class='list-group-item'>Telefono: ".$delivery->telefono."</li>
                                  <li class='list-group-item'>Email: ".$delivery->email."</li>
                                </ul>
                                <div class='card-body'>
                                <form action='/admin/habilitarDelivery' method='POST'><button type='submit' name='idUsuario' value='".$delivery->idUsuario."' class='btn btn-primary'>HABILITAR</button></form>
                                <form action='/admin/eliminarDelivery' method='POST'><button type='submit' name='idUsuario' value='".$delivery->idUsuario."' class='btn btn-danger'>ELIMINAR</button></form>
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
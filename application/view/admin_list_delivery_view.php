
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Lista de Deliverys</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>E-mail</th>
            <th>Entregas</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Telefono</th>
            <th>E-mail</th>
            <th>Entregas</th>
          </tr>
        </tfoot>
        <tbody>
          
          <?php 
              if(isset($data)){
              foreach ($data as $key => $delivery) {
                echo "<tr>
                        <td>".$delivery->idUsuario."</td>
                        <td>".$delivery->nombre."</td>
                        <td>".$delivery->apellido."</td>
                        <td>".$delivery->telefono."</td>
                        <td>".$delivery->email."</td>
                        <td>".$delivery->entregas."</td>
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

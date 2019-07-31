
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-table"></i>
    Lista de Comercios</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Numero</th>
            <th>Nombre</th>
            <th>E-mail</th>
            <th>Ciudad</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Numero</th>
            <th>Nombre</th>
            <th>E-mail</th>
            <th>Ciudad</th>
          </tr>
        </tfoot>
        <tbody>
          <?php 

            foreach ($data as $key => $comercio) {
              echo "<tr>
                      <td>".$comercio->idComercio."</td>
                      <td>".$comercio->razonSocial."</td>
                      <td>".$comercio->email."</td>
                      <td>".$comercio->ciudad."</td>
                    </tr>";
            }

           ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

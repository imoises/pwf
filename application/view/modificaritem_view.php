
<?php 
if(is_null($data["fotoBanner"])){
	echo '<img class="materialboxed"  id="banner" src="../application/resources/img/bannerdefault.jpg">';
}else{
echo '<img class="materialboxed"  id="banner" src='.$data["fotoBanner"].'>';
}?>

<div class="fondo">
<br>
  <div class="row section container" id="fondo">
    <form class="col s12" action="/comercio/modificarItems" METHOD="POST" ENCTYPE="multipart/form-data">
      <div class="row">
        <div class="input-field col s6">
          <input name="nombre" type="text" class="validate white-text" value="<?php echo(urldecode($_GET['nombre'])) ?>">;
          <label for="nombre">Nombre</label>
        </div>
        
        <div class="input-field col s6">
          <input name="stock" type="text" class="validate white-text" value="<?php echo(urldecode($_GET['stock'])) ?>">
          <label for="stock">Stock</label>
        </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
              <input name="precio" type="text" class="validate white-text" value="<?php echo(urldecode($_GET['precio'])) ?>">
              <label for="precio">Precio</label>
            </div>

            <div class="input-field col s6">
              <p class="validate white-text">Oferta
                <label>
                  <input class="with-gap" name="oferta" type="radio" value="1" checked />
                  <span>Si</span>
                </label>
                <label>
                  <input class="with-gap" name="oferta" type="radio" value="0" />
                  <span>No</span>
                </label>
              </p>
            </div>
        </div>

          <div class="row">
            <div class="input-field col s12">
          <input name="descripcion" type="text" class="validate white-text" value="<?php echo(urldecode($_GET['descripcion'])) ?>">
          <label for="descripcion">Descripción</label>
        </div>            
        </div>
        <div class="row">
        <div class="col s3 offset-s5">
        <button class="waves-effect waves-light btn-large orange darken-4" type="submit" name="submit">Modificar</button>
        </div> 
        
        </div>
      
</form>
</div>
</div>

<style>
  .fondo{
      background-image: url("../application/resources/img/fonditominimalista.jpg");
   	height: 100%;
    background-position: center;
   	background-repeat: repeat;
    background-size: cover;
    position: relative;
  	margin-top: -45px;
  }
  #banner{
    height: 300px;
    width: 100%;
  }

  #fondo{
    background-color:rgba(0,0,0,0.8);
  }
</style>
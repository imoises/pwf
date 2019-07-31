<?php 
if(is_null($data["fotoBanner"])){
	echo '<img id="banner" src="../application/resources/img/bannerdefault.jpg">';
}else{
echo '<img id="banner" src='.$data["fotoBanner"].'>';
}?>

<div class="fondo">

		<div class="right-align">
		<a href="#!">
		<i class="fas fa-pencil-alt fa-2x iconobaner"></i>
		</a>
		</div>

 <div class="section container">
  <div class="row">

<?php 
if(isset($data['item'])){

foreach($data['item'] as $key=>$item){

	if(!is_null($item)){


echo 
'<div class="col s12 l4">
  <div class="card">
    <div class="card-image">
     <img class="materialboxed" height="250" width="50" src='. $item->foto. '>
    </div>
    <div class="card-content">
	 <span class="card-title activator grey-text text-darken-4">'. $item->nombre .'
	  <i class="material-icons right">more_vert</i></span>
	  <h6> Precio: $' . $item->precio .'</h6> 
	  <div class="row">
	  <div class="col s2 offset-s8">
	  <a href="/comercio/formularioModificar?nombre='.urlencode($item->nombre)."&stock=".$item->stock."&precio=".$item->precio."&oferta=".$item->oferta."&descripcion=".urlencode($item->descripcion).'"><i id="edit" class="fas fa-edit fa-2x"></i></a>
	  </div>
	  <div class="col s2">
	  <a href="#demo-modal-'.$item->nombre.'" class="modal-trigger"><i id="delete" class="fas fa-trash fa-2x"></i></a>
	  </div>
      </div>
	  </div>
    <div class="card-reveal">
    <span class="card-title grey-text text-darken-4">'. $item->nombre .'<i class="material-icons right">close</i></span>
      <p>'. $item->descripcion . '</p>
	Stock disponible: '. $item->stock .'
	<br>
    </div>
  </div>
	</div>
	
	<div id="demo-modal-'.$item->nombre.'" class="modal">

    <div class="modal-content">
      <h4>Borrar el producto <span class="red-text">"'.$item->nombre.'"</span> de su listado</h4><br>
      <h5>¿Desea borrar el producto <span id="red"></span> de su lista?</h5><br><br>
      	<form class="col s12" action="/comercio/borrarItems" METHOD="POST" ENCTYPE="multipart/form-data">
	      <div class="row">
	      <div class="col s1 offset-s5">
				<button class="waves-effect waves-light btn-large orange darken-4" type="submit" name="submit" 
				value="'.$item->nombre.'">Borrar</button>
        </div>
	        
	      </div>
		</form>  
  </div>
</div>';
  
} 
} 
}?>

<div class="fixed-action-btn">
  <a class="btn-floating btn-large orange lighten-3" href="/comercio/formularioAgregar" id="boton">
    <i class="large material-icons" id="add" title="Agregar nuevo item">add</i>
  </a>
</div>

<!-- Modal Structure -->


</div>
</div>
</div>

<script>
$(document).ready(function(){
    $('.modal').modal();
  })
</script>

<style>
#ds{
	height: 100%;
	width: 100%;
}
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
	height: 350px;
	width: 100%;
}
#edit{
	color: #81c784;
	transition: color 0.7s ease;

}
#delete{
	color: #ff5722;
	transition: color 0.7s ease;

}

#edit:hover{
	color: green;
	transform: scale(1.5);
	transition: 1s ease;
}

#delete:hover{
	color: red;	
	transform: scale(1.5);
	transition: 1s ease;
}
#add{
	color: #e65100;
	transition: background-color 1s ease;

}
#add:hover{
	color: #e65100 ;
	background-color: #f57f17;

}
#boton:hover{
	transform: scale(1.7);
	margin: 15px;
	-webkit-transition: all 1s ease-in;
  -moz-transition: all 1s ease-in;
  -o-transition: all 1s ease-in;
  transition: all 1s ease-in;
}
#red{
	color: red;
}
.iconobaner{
	color: #dd2c00;
	font-size: 44px;
	margin-top: -55px;
}

*{
	box-sizing: border-box;
}

</style>
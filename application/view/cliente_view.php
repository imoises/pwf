<div class="fondo">
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
	  <a href=""><i id="edit" class="fas fa-edit fa-2x"></i></a>
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
	</div>';
  
} 
} 
}?>

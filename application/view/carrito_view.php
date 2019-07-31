<?php

    echo "  <br><br><div class='fondo'>

            <div class='section container xdxdxdxd'>";
    if (isset($_SESSION['comercioActual'])) {
           echo "  <div class='row'>
            <div class='col s3'>
            <br>
            <form action='/product/buscarProducto' method='POST'>
                <input name='idComercio' type='hidden' value='".$_SESSION['comercioActual']."'>
                <button class='btn-large orange darken-3' type='submit' name='btn'><i class='material-icons left'>
                keyboard_backspace</i>Volver</button>
            </form>
            </div>
            <br>
            </div>";
       }else{
            
       }
            
if($data)
    {
        $total=0;
        foreach($data as $producto)
        {
            $cantidad=$producto["cantidad"];
            
              echo "<div class='card'>
                    <div class='row'>

                    <div class='col s2'>
                    <img height=250 src='".$producto["foto"]." '>
                    </div>
                    
                    
                    <div class='col s3 offset-s2 center-align'>
                        <h3 class='orange-text text-darken-4'> ".$producto["nombre"]."</h3>
                        <h5 class='black-text'> Unidades: <span class='orange-text text-darken-4'>".$producto["cantidad"]."</span></h5>
                        <h5 class='black-text'>Precio: <span class='orange-text text-darken-4'>".$producto["precio"]."</span></h5>
                        <h5 class='black-text'>Total: <span class='orange-text text-darken-4'>$".$producto["cantidad"]*$producto['precio']."</span></h5>
                    </div>
                            
                    <div class='col s3 offset-s2'>    
                    <a class='btn-large orange darken-3' id='boton' href='/cliente/eliminarDelCarrito?item=".$producto['unique_id']."'>
                     <i class='material-icons right'>delete</i>Eliminar</a>
                    </div>

                    </div>
                    </div>";

				$total+=($producto["cantidad"]*$producto["precio"]);
                }
                
        echo "<h3 class='center-align'>El precio total es de <span class='orange-text text-darken-4'>$".$total."</span></h3>"; 
    } else{
        echo "<script>alert('El carro esta vacio');</script>";
        echo "<h1>Carro vacio</h1>";
        echo "<a class='btn-large orange darken-3' href='/'>Volver a Menu</a>";
         }
         if (isset($_SESSION['carrito'])) {
            if($_SESSION['carrito']['articulos_total']>0){
                echo "
                <br>
                <div class='row'><div class='col s3 offset-s5'>
                <a class='right-align btn-large orange darken-3' href='/cliente/confirmarPedido'><i class='material-icons right'>
                check
                </i> Confirmar Pedido </a></div></div>
                </div></div>";
            }
            
         }
        ?>


<style>

.marco{
    border: 1px;
}
#boton{
    margin-top: 90px;
}
.fondo{
  background-image: url("../application/resources/img/fondito4.jpg");
  height: 100%;
  /* background-position: center; */
  /* background-repeat: repeat; */
  /* background-size: cover; */
  position: relative;
  margin-top: -45px;
}
.xdxdxdxd{
    background-color: white;
}
</style>
<br><br>
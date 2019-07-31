<?php
require("./application/model/model_product.php");
require("./application/model/Model_Carrito.php");
require("./application/model/model_pedido.php");

class Controller_Cliente extends Controller{   
	public function agregarAlCarrito(){
        $product = new model_product();
        $nombre = $_POST["nombre"];
		$comercio = $_POST["comercio"];
		$cantidad = $_POST["cantidad"];
        $array = $product->obtenerArrayProducto($comercio,urldecode($nombre),$cantidad);
        $carrito = new Model_Carrito();
        $carrito->add($array);
		$contenido = $carrito->get_content();
		//$data = array('idComercio' => $_POST["comercio"], 'contenido'=> $contenido);
		$this->crearSesionComercioActualCarrito($_POST['comercio']);
		$this->view->generate('carrito_view.php','templatecomercio_view.php',$contenido);
    }
	public function eliminarDelCarrito(){
		$product = new model_product();
        $id = $_GET["item"];
		$carrito = new Model_Carrito();
		$carrito->remove_producto($id);
		$contenido = $carrito->get_content();
		$this->view->generate('carrito_view.php','templatecomercio_view.php',$contenido);    	
	}
	public function confirmarPedido(){
		$carrito = new Model_Carrito();
		$carritoListo = $carrito->get_content();
		if(!isset($carritoListo)){
			echo "Carrito no encontrado";
		}
		else{
			$pedido = new model_pedido();
			$pedido->crearPedido($carritoListo);
			$carrito->destroy();
			$product = new model_product();
			$data['item'] = $product->traerItemsPorCiudad("San Justo");
        	$this->view->generate('main_view.php', 'template_view.php', $data);
		}
		//$product = new model_product();
        //$data = $product->traerItemsPorCiudad("San Justo");
        //$this->view->generate('product_list_view.php', 'templatecomercio_view.php', $data);
	}

	public function agregadosacarrito(){
		$carrito = new Model_Carrito();
		$contenido = $carrito->get_content();
		$this->view->generate('carrito_view.php','templatecomercio_view.php',$contenido);
	}

	private function crearSesionComercioActualCarrito($idComercio){
		$_SESSION['comercioActual']=$idComercio;
	}

	public function cancelarPedido(){
		$pedido = new model_pedido();
		$pedido->cancelarPedido($_POST["pedido"]);
		$dataPedido['pedido']=$pedido->traerPedidosCliente();
		$dataPedido2['pedido2']=$pedido->traerPedidosCliente2();
		$resultado = array_merge($dataPedido, $dataPedido2);
		$this->view->generate('pedidos_list_view.php','template_view.php',$resultado);
	}
}
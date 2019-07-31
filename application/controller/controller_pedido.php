<?php

class Controller_Pedido extends Controller{
    function index(){
		$pedido = new model_pedido();
		switch($_SESSION['login']['rol']){
			case 'cliente':
			$dataPedido['pedido']=$pedido->traerPedidosCliente();
			$dataPedido2['pedido2']=$pedido->traerPedidosCliente2();
			$resultado = array_merge($dataPedido, $dataPedido2);
			break;
			case 'op-comercio':
			$dataPedido['pedido']=$pedido->traerPedidosComercio();
			$dataPedido2['pedido2']=$pedido->traerPedidosComercio2();	
			$resultado = array_merge($dataPedido, $dataPedido2);
			break;
			case 'delivery':
			$this->view->generate('delivery_view.php', 'templatecomercio_view.php');
			break;
		}
		if($_SESSION['login']['rol'] == 'cliente' || $_SESSION['login']['rol'] == 'op-comercio' ){
		$this->view->generate('pedidos_list_view.php','template_view.php',$resultado);          
	}
	}
}
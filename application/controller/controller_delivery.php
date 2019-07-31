<?php

require("./application/model/Model_Pedido.php");

class Controller_Delivery extends Controller{
    /*function index(){
        $this->view->generate('delivery_view.php', 'templatecomercio_view.php');
    }
*/
    function tomarPedidos(){
    	$idPedido = $_GET["idPedido"];
    	$pedido= new model_pedido;
    	$tomarPedidos = $pedido->tomarPedidos($_SESSION['login']['idUsuario'],$idPedido);
        $this->view->generate('delivery_view.php', 'templatecomercio_view.php',$tomarPedidos);
    }

    function pedidoRealizado(){
    	$idPedido = $_GET["idPedido"];
    	$pedido= new model_pedido;
    	$pedidoRealizado = $pedido->realizarPedidos($_SESSION['login']['idUsuario'],$idPedido);
        $this->view->generate('delivery_view.php', 'templatecomercio_view.php', $pedidoRealizado);
    }
    function reciboPedido(){    
        $idPedido = $_GET["idPedido"];
        $pedido= new model_pedido;
        $pedidoRealizado = $pedido->reciboPedido($idPedido);
        $this->view->generate('delivery_view.php', 'templatecomercio_view.php', $pedidoRealizado);
    }
}
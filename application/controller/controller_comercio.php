<?php
require("./application/model/model_item.php");
require("./application/model/model_usuario.php");
require("./application/model/model_pedido.php");
class Controller_Comercio extends Controller{   

    function agregarItems(){
        $item = new model_item();

            $data = $item->agregarItems($_SESSION['login']['idComercio'],$_POST['nombre'],$_POST['stock'],
             $_FILES['foto']['name'],$_FILES['foto']['tmp_name'],$_POST['oferta'],$_POST['precio'],$_POST['descripcion']);
            if($data==true){
                    $comercio= new model_comercio();
                    $dataItem['item']=$comercio->traerItems($_SESSION['login']['idComercio']);
                    $datos=$comercio->traerDatos($_SESSION['login']['idComercio']);
                    $data=array_merge($dataItem,$datos);
                    $this->view->generate('comercio_view.php','templatecomercio_view.php',$data);
                    }      
    }

    function formularioAgregar(){
        $comercio2= new model_comercio();
        $data=$comercio2->traerDatos($_SESSION['login']['idComercio']);
        $this->view->generate('agregaritem_view.php','templatecomercio_view.php',$data);
    }
    
    /*function formularioBorrar(){

        $comercio3= new model_comercio();
        $data=$comercio3->traerDatos($_SESSION['login']['idComercio']);
        $this->view->generate('borraritem_view.php','templatecomercio_view.php',$data);

    }*/

    function borrarItems(){
        $item = new model_item();
            $data = $item->borrarItems($_SESSION['login']['idComercio'],$_POST['submit']);
            if($data==true){
                    $comercio= new model_comercio();
                    $dataItem['item']=$comercio->traerItems($_SESSION['login']['idComercio']);
                    $datos=$comercio->traerDatos($_SESSION['login']['idComercio']);
                    $data=array_merge($dataItem,$datos);
                    $this->view->generate('comercio_view.php','templatecomercio_view.php',$data);
                    }      
    }

    function modificarItems(){
            $item = new model_item();
            $data = $item->modificarItems($_SESSION['login']['idComercio'],$_POST['nombre'],$_POST['stock'],
            $_POST['precio'],$_POST['oferta'],$_POST['descripcion']);

            if($data==true){
                    $comercio3= new model_comercio();
                    $dataItem['item']=$comercio3->traerItems($_SESSION['login']['idComercio']);
                    $datos=$comercio3->traerDatos($_SESSION['login']['idComercio']);
                    $data=array_merge($dataItem,$datos);
                    $this->view->generate('comercio_view.php','templatecomercio_view.php',$data);
                    }  
    }

    function formularioModificar(){
        $item= new model_item();
        $comercio= new model_comercio();
        $dataItem['item']=$item->guardarNombreItem(urldecode($_GET['nombre']));
        $datos=$comercio->traerDatos($_SESSION['login']['idComercio']);
        $data=array_merge($dataItem,$datos);
        $this->view->generate('modificaritem_view.php','templatecomercio_view.php',$data);
    }
	
	function confirmarPedido(){
		$pedido= new model_pedido();
		$pedido->confirmarPedido($_POST['pedido']);
		$dataPedido['pedido']=$pedido->traerPedidosComercio();
		$dataPedido2['pedido2']=$pedido->traerPedidosComercio2();	
		$resultado = array_merge($dataPedido, $dataPedido2);
        $this->view->generate('pedidos_list_view.php','template_view.php',$resultado);
	}
}
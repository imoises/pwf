<?php
require("./application/model/model_comercio.php");
require("./application/model/model_product.php");
class Controller_Main extends Controller{
    function index(){

        $ciucom = new model_main();
        $ciudades = $ciucom->traerCiudades();
        $comercios = $ciucom->traerComercios();
        $ciucom->crearSessionCiudadComercio($ciudades,$comercios);

		if(isset($_SESSION['login']['rol'])){
			   switch ($_SESSION['login']['rol']) {
                case 'cliente':
					$product = new model_product();
					if(isset($_SESSION['comercioPedido'])){
						$data = $product->traerItemsDelComercio($_SESSION['comercioPedido']);
					}
					else {
						$data = $product->traerTodosLosItems();
					}
                    $this->view->generate('main_view.php','template_view.php');
                    break;
                case 'delivery':
                    $this->view->generate('delivery_view.php', 'templatecomercio_view.php');
                    break;
                case 'op-comercio':
                    $comercio= new model_comercio();
                    $dataItem['item']=$comercio->traerItems($_SESSION['login']['idComercio']);
                    $datos=$comercio->traerDatos($_SESSION['login']['idComercio']);
                    $data=array_merge($dataItem,$datos);
                    $this->view->generate('comercio_view.php','templatecomercio_view.php',$data);
                    break;
                case 'op-sistema':
                    $this->view->generate('admin_tarea_view.php','templateadmin_view.php');
                    break;
            }
		}
		else{
            $this->view->generate('main_view.php', 'template_view.php');
		}
	}

    function nosotros(){
        $this->view->generate('nosotros_view.php','templatecomercio_view.php');
    }
}
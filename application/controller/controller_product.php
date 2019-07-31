<?php
require("./application/model/model_comercio.php");

class Controller_Product extends Controller{
    function index(){
        $this->view->generate('main_view.php','template_view.php');
    }

    function listProduct(){
        $data = $this->model->getList();
        $this->view->generate('product_list_view.php', 'template_view.php', $data);
    }

    function buscarProducto() {
        
        if (isset($_SESSION['login']['rol'])) {
            if (isset($_POST['idComercio']) && $_SESSION['login']['rol'] == "cliente") {
                $comercio= new model_comercio();
				if(isset($_POST['categoria'])){
					$datos['item'] = $this->model->traerCategoriaDeItemsDelComercio($_POST['idComercio'],$_POST['categoria']);
				}
				else{
                $datos['item'] = $this->model->traerItemsDelComercio($_POST['idComercio']);
                }
				$comercio = $comercio->traerDatos($_POST['idComercio']);
                $data=array_merge($datos,$comercio);
                $this->view->generate('product_list_view.php', 'templatecomercio_view.php', $data);
            }
        }else{
            $this->view->generate('main_view.php','template_view.php');
        }
        
    }

}
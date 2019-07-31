<?php
 require("./application/model/model_product.php");

class Controller_Restaurant extends Controller{
    function index(){
        $this->view->generate('main_view.php','template_view.php');
    }

    function restaurantes() {
        unset($_SESSION['comercioActual']);
        unset($_SESSION['carrito']);
        $comercio = new model_product();
        if (isset($_SESSION['login']['rol'])) {
            if (isset($_POST['ciudad'])) {
                if ($_POST['ciudad'] == "") {
                    $this->view->generate('main_view.php','template_view.php');
                }else{
                    $data = $comercio->traerTodosLosComerciosDeEstaCiudad($_POST['ciudad']);
                    $this->view->generate('cliente_list_comercio_view.php', 'templatecomercio_view.php', $data);
                }
            }
        }else{
			$error = "Ingrese o registrese para poder ver los restaurantes.";
            $this->view->generate('login_view.php','template_view.php',$error);
        }
    }

    function productos() {
        $producto = new model_product();
        $data = $producto->traerItemsDelComercio($_GET['Drestaurant']);
        $this->view->generate('product_list_view.php', 'templatecomercio_view.php', $data);
    }
}
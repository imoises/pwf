<?php
require_once("./application/model/model_usuario.php");
require_once("./application/model/model_main.php");
require("./application/model/model_comercio.php");
class Controller_Login extends Controller{
    function index(){
        $this->view->generate('login_view.php', 'template_view.php');
    }

    function validarUser(){

        $usuario = new model_usuario();
		
        $data = $usuario->logueo($_POST['user'],$_POST['pass']);
        
        if($data == true){
            switch ($_SESSION['login']['rol']) {
                case 'cliente':
					$ciucom = new model_main();
					$ciudades = $ciucom->traerCiudades();
					$comercios = $ciucom->traerComercios();
					$ciucom->crearSessionCiudadComercio($ciudades,$comercios);
                    $this->view->generate('main_view.php','template_view.php');
                    break;
                case 'delivery':
					$usuario->eliminarEstado();
					$usuario->activarEstadoDelivery();
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
                    $comercio = new model_comercio();
                    $data = $comercio->traerTodosLosComerciosPendientesAHabilidar();
                    if ($data==false) {
                        $data="vacio";
                    }
                    $this->view->generate('admin_tarea_view.php','templateadmin_view.php',$data);
                    break;
            }
		}
		if($data==false){
			$error = "Usuario o contraseña incorecta.";
			$this->view->generate('login_view.php','template_view.php',$error);
		}
    }
    function cerrarSesion() {
		if($_SESSION['login']['rol'] == 'delivery'){
			$usuario = new model_usuario();
			$usuario->eliminarEstado();
		}
        unset( $_SESSION['login'] );
		session_destroy();		
        $this->view->generate('login_view.php','template_view.php');
    }
}
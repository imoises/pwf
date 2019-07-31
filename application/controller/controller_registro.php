<?php
require_once("./application/model/model_usuario.php");
require_once("./application/model/model_comercio.php");

class Controller_Registro extends Controller{
    function index(){
        $this->view->generate('registro_view.php', 'template_view.php');
    }
	function registrarUsuario(){
		$usuario = new model_usuario();
		switch($_POST['rol']){
			case 'cliente':
	        $data = $usuario->registrar($_POST['email'],$_POST['password'],$_POST['nombre'],$_POST['apellido'],$_POST['telefono'],
			$_POST['rol'],$_POST['direccion'],'','0');
			break;
			case 'delivery':
			$data = $usuario->registrar($_POST['email'],$_POST['password'],$_POST['nombre'],$_POST['apellido'],$_POST['telefono'],
			$_POST['rol'],'','','0');
			break;
			case 'op-comercio':
			$data = $usuario->registrar($_POST['email'],$_POST['password'],$_POST['nombre'],$_POST['apellido'],$_POST['telefono'],
			$_POST['rol'],'','','0');
			break;
		}
		if($data==true){
            $this->view->generate('login_view.php', 'template_view.php');
		}
		if($data==false){
			$error = 'Error';
			$this->view->generate('registro_view.php','template_view.php',$error);
		}
        
	}

	function registrarComercio(){
		if (isset($_POST['btnRegistComercio'])) {
			if ($_POST['email']!="" && $_POST['razonSocial']!="" && $_POST['ciudad']!="" && $_POST['direccion']!="") {
				$comercio = new model_comercio();
				$valor = $comercio->registrarComercio($_POST['email'],$_POST['razonSocial'],$_POST['ciudad'],$_POST['direccion'],$_FILES['fotoBanner']['name'],$_FILES['fotoBanner']['tmp_name'],$_POST['tiempoEntrega']);
				$this->view->generate('login_view.php','template_view.php');
			}else{
				$this->view->generate('registro_comercio_view.php','template_view.php');
			}
		}else{
			$this->view->generate('registro_comercio_view.php','template_view.php');
		}
	}
}
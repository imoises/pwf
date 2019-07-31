<?php 
require("./application/model/model_comercio.php");
require("./application/model/model_usuario.php");
require("./application/model/model_pedido.php");

class Controller_Admin extends Controller{   
	public function index(){
		if (isset($_SESSION['login']['rol'])) {
			if ($_SESSION['login']['rol']=='op-sistema'){
				$this->view->generate('admin_tarea_view.php','templateadmin_view.php');
			}else{
				$this->view->generate('main_view.php','template_view.php');
			}
		}else{
        	$this->view->generate('main_view.php','template_view.php');
		}
	}

	public function tareas(){
		$comercio= new model_comercio();
		$data = $comercio->traerTodosLosComerciosPendientesAHabilidar();
		if ($data==false) {
			$data="vacio";
		}
		$this->view->generate('admin_tarea_view.php','templateadmin_view.php',$data);
	}

	public function estadistica_economico(){
		// resultados economicos
		$this->view->generate('admin_estadistica_economico_view.php','templateadmin_view.php');
	}

	public function list_comercio(){
		$comercio= new model_comercio();
		$data = $comercio->traerTodosLosComerciosHabilitados();
		$this->view->generate('admin_list_comercio_view.php','templateadmin_view.php',$data);
	}

	public function list_delivery(){
		$usuario= new model_usuario();
		$usuariosConEntregas = $usuario->traerTodosLosDeliverysQueHicieronEntregas();
		$usuariosSinEntregas = $usuario->traerTodosLosDeliverysQueNoHicieronEntregas();
		if ($usuariosConEntregas==false) {
			$this->view->generate('admin_list_delivery_view.php','templateadmin_view.php',$usuariosSinEntregas);
		}else{
			if ($usuariosSinEntregas==false) {
				$this->view->generate('admin_list_delivery_view.php','templateadmin_view.php',$usuariosConEntregas);
			}else{
				$data=array_merge($usuariosConEntregas,$usuariosSinEntregas);
				$this->view->generate('admin_list_delivery_view.php','templateadmin_view.php',$data);
			}
		}
	}

	public function habilitarComercio(){
		$comercio = new model_comercio();
		$usuario= new model_usuario();
		$comercio->darDeAltaComercio($_POST['idComercio']);
		//$usuariosParaEnviarPorEmail = $usuario->traerLosCincoUsuariosDelComercio($_POST['idComercio']);
		//$comercio->enviarEmailLosUsuariosHabilitados($usuariosParaEnviarPorEmail);
		$data = $comercio->traerTodosLosComerciosPendientesAHabilidar();
		if ($data==false) {
			$data="vacio";
		}
		$this->view->generate('admin_tarea_view.php','templateadmin_view.php',$data);
	}

	public function eliminarComercio(){
		$comercio = new model_comercio();
		$comercio->eliminarComercioPendientesAHabilidar($_POST['idComercio']);
		$data = $comercio->traerTodosLosComerciosPendientesAHabilidar();
		if ($data==false) {
			$data="vacio";
		}
		$this->view->generate('admin_tarea_view.php','templateadmin_view.php',$data);
	}

	public function tareaHabilitarDelivery(){
		$usuario= new model_usuario();
		$data = $usuario->traerTodosLosUsuariosTipoDeliveryPendientesAHabilidar();
		if ($data==false) {
			$data="vacio";
		}
		$this->view->generate('admin_tarea_habil_delivery_view.php','templateadmin_view.php',$data);
	}

	public function habilitarDelivery(){
		$usuario = new model_usuario();
		$usuario->darDeAltaDelivery($_POST['idUsuario']);
		$usuarioParaEmail = $usuario->traerUsuario($_POST['idUsuario']);
		$usuario->enviarEmailAltaDelivery($usuarioParaEmail);

		$data = $usuario->traerTodosLosUsuariosTipoDeliveryPendientesAHabilidar();
		if ($data==false) {
			$data="vacio";
		}
		$this->view->generate('admin_tarea_habil_delivery_view.php','templateadmin_view.php',$data);
	}
	
	public function eliminarDelivery(){
		$usuario = new model_usuario();
		$usuario->eliminarDeliveryPendientesAHabilidar($_POST['idUsuario']);

		$data = $usuario->traerTodosLosUsuariosTipoDeliveryPendientesAHabilidar();
		if ($data==false) {
			$data="vacio";
		}
		$this->view->generate('admin_tarea_habil_delivery_view.php','templateadmin_view.php',$data);
	}

	public function liquidarComercio(){
		$pedido = new model_pedido();
		if (isset($_POST['action'])) {
			$data = $pedido->traerComerciosConRecaudacion($_POST['mes'],$_POST['año']);
			$this->view->generate('admin_tarea_liquidacion_comercio_view.php','templateadmin_view.php',$data);
		}else{
			$this->view->generate('admin_tarea_liquidacion_comercio_view.php','templateadmin_view.php');
		}
	}

	public function liquidarDelivery(){
		$pedido = new model_pedido();
		if (isset($_POST['action'])) {
			$data = $pedido->traerDeliverysConRecaudacion($_POST['mes'],$_POST['año']);
			$this->view->generate('admin_tarea_liquidacion_delivery_view.php','templateadmin_view.php',$data);
		}else{
			$this->view->generate('admin_tarea_liquidacion_delivery_view.php','templateadmin_view.php');
		}
	}

	public function realizarLiquidacionDelivery(){
		$pedido = new model_pedido();
		if (isset($_POST['deliverys'])) {
			$pedido->liquidarADeliverys($_POST['deliverys']);
			$this->view->generate('admin_tarea_liquidacion_delivery_view.php','templateadmin_view.php');
		}else{
			$this->view->generate('admin_tarea_liquidacion_delivery_view.php','templateadmin_view.php');
		}
	}

	public function realizarLiquidacionComercios(){
		$pedido = new model_pedido();
		if (isset($_POST['comercios'])) {
			$pedido->liquidarAComercios($_POST['comercios']);
			$this->view->generate('admin_tarea_liquidacion_comercio_view.php','templateadmin_view.php');
		}else{
			$this->view->generate('admin_tarea_liquidacion_comercio_view.php','templateadmin_view.php');
		}
	}

}
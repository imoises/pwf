<?php
require("./application/model/model_usuario.php");
require("./application/model/model_product.php");

class Controller_modificarPerfil extends Controller{
    function index(){
		$usuario=new model_usuario();
        $datos= $usuario->traerDatos($_SESSION['login']['email']);
        if($_SESSION['login']['rol'] == 'cliente'){
        $this->view->generate('modificar_view.php','template_view.php',$datos);
        }else{
            $this->view->generate('modificar3_view.php','template_modificar_view.php',$datos);
        }
    }
    
    function modificarUser(){

        if($_SESSION['login']['rol'] == 'cliente'){
        $usuario = new model_usuario();		
        $data = $usuario->modificarUsuario($_POST['email'],$_POST['password'],$_POST['nombre'],$_POST['apellido'],
        $_POST['telefono'], $_POST['direccion']);
		if($data==true){
            $this->view->generate('main_view.php','template_view.php');
        }
        if($data==false){
            $error = "Error";
            $this->view->generate('modificar_view.php','template_view.php',$error);
        }
        
        }elseif($_SESSION['login']['rol'] == 'op-comercio'){
        $usuario2 = new model_usuario();
        $data2 = $usuario2->modificarComercio($_POST['email'],$_POST['password'],$_POST['nombre'],
        $_POST['apellido'],$_POST['telefono']);
        if($data2==true){
        $comercio = new model_comercio();
        $datos = $comercio->traerItemsPorComercio($_SESSION['idComercio']);  
        $this->view->generate('product_list_view.php','templatecomercio_view.php',$datos);
        }
        if($data2==false){
            $error2 = "Error";
            $this->view->generate('modificar_view.php','template_view.php',$error2);
        }
        }elseif($_SESSION['login']['rol'] == 'delivery'){
            $usuario3 = new model_usuario();
            $data3 = $usuario3->modificarDelivery($_POST['email'],$_POST['password'],$_POST['nombre'],
            $_POST['apellido'],$_POST['telefono']);
            if($data3==true){
            $this->view->generate('main_view.php','template_view.php');
            }
            if($data3==false){
                $error3 = "Error";
                $this->view->generate('modificar_view.php','template_view.php',$error3);
            }
            }


    
    }
    }


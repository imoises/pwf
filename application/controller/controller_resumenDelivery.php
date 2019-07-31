<?php
require("./application/model/model_resumen.php");
class Controller_ResumenDelivery extends Controller{

    function index(){
        $this->view->generate('resumen_delivery_view.php','templatecomercio_view.php');
    }

    function traerResumen(){
        $resumen = new model_resumen();
        $data['datos1'] = $resumen->resumenDelivery($_SESSION['login']['idUsuario'],$_POST['mes'],$_POST['año']);
        // $data2['datos2'] = $resumen->resumenItem2($_SESSION['login']['idUsuario'],$_POST['mes'],$_POST['año']);
        // $data = array_merge($data1,$data2);
        $this->view->generate('resumen_delivery_view.php','templatecomercio_view.php',$data);
    }
}
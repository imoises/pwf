<?php

class Controller_Resumen extends Controller{

    function index(){
        $this->view->generate('resumen_view.php','templatecomercio_view.php');
    }

    function traerResumen(){
        $resumen = new model_resumen();
        $data1['datos1'] = $resumen->resumenItem($_SESSION['login']['idComercio'],$_POST['mes'],$_POST['año']);
        $data2['datos2'] = $resumen->resumenItem2($_SESSION['login']['idComercio'],$_POST['mes'],$_POST['año']);
        $data = array_merge($data1,$data2);
        $this->view->generate('resumen_view.php','templatecomercio_view.php',$data);
    }
}
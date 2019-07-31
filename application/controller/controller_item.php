<?php
 require("./application/model/model_comercio.php");

 class Controller_Item extends Controller{

     function items(){
         $comercio = new model_comercio();
         $dataitem=$comercio->traerItems($_SESSION['login']['idComercio']);
         $this->view->generate('comercio_view.php','templatecomercio_view.php',$dataitem);
     }
 } 
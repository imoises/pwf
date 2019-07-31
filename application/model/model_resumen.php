<?php
require_once 'modelo_config_DB.php';

class Model_Resumen extends Model{

    public function resumenItem($idComercio,$mes,$año){
        $conn = DataBase::conection();
        $sql ="select ci.idPedido idPedido, nombre NombreItem , sum(ci.cantidad) Cantidad, item.foto as Foto, item.precio PrecioUnitario, 
        p.idComercio as Comercio, sum(p.precio) as PrecioTotal
        from item inner join contieneitem ci on ci.IdItem=item.id join pedido p on ci.idPedido = p.idPedido
        where p.idComercio=$idComercio and month(tiempoPedido)=$mes and year(tiempoPedido)=$año and p.estadoPedido='Realizado'";
        $result = mysqli_query($conn,$sql);
        while ($obj[] = $result->fetch_object()) {
            //no hace nada aca dentro
        }
        return $obj;
        }
    

    public function resumenItem2($idComercio,$mes,$año){
        $conn = DataBase::conection();
        $sql ="select sum(precio) as Total from pedido p where p.idComercio=$idComercio 
        and month(tiempoPedido)=$mes and year(tiempoPedido)=$año";
        $result = mysqli_query($conn,$sql);
        while ($obj[] = $result->fetch_object()) {
            //no hace nada aca dentro
        }
        return $obj;
        }

    public function resumenDelivery($Delivery,$mes,$año){
        $conn = DataBase::conection();
        $sql ="select sum(precio) Dinero, count(p.idPedido) Pedidos
        from pedido as p inner join usuario as u on u.idComercio=p.idComercio 
        where estadoPedido='Realizado' and idDelivery=$Delivery and month(tiempoPedido)=$mes and year(tiempoPedido)=$año and p.estadoPedido='Realizado'";
        $result = mysqli_query($conn,$sql);
        while ($obj[] = $result->fetch_object()) {
            //no hace nada aca dentro
        }
        return $obj;
        }

    // public function resumenDelivery2($idComercio,$mes,$año){
    //     $conn = DataBase::conection();
    //     $sql ="select sum(precio) as Total from pedido p where p.idComercio=$idComercio 
    //     and month(tiempoPedido)=$mes and year(tiempoPedido)=$año";
    //     $result = mysqli_query($conn,$sql);
    //     while ($obj[] = $result->fetch_object()) {
    //         //no hace nada aca dentro
    //     }
    //     return $obj;
    //     }


        
    }
    
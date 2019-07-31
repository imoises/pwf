<?php
require_once 'modelo_config_DB.php';

class Model_Pedido extends Model{
	private $listaItems;
	private $precioTotal;

	public static function crearPedido($carrito){
	
		date_default_timezone_set('America/Buenos_Aires');
		$estadoPedido = "A confirmar";
		$tiempoPedido = date('Y-m-d H:i:s');
		$conn = DataBase::conection();
		if($stmt = $conn->prepare("insert into pedido (tiempoPedido, estadoPedido, idCliente,idComercio) values (?,?,?,?)")){
			$stmt->bind_param("ssii",$tiempoPedido,$estadoPedido,
				$_SESSION['login']['idUsuario'],$_SESSION['comercioActual']);
			$stmt->execute();
		}
		$idPedido = $conn->insert_id;
		$total = 0;
		foreach($carrito as $key=>$item){
			if(!is_null($item)){
				$sql = "Insert into contieneItem values (".$idPedido.",".$item['cantidad'].",".$item['id'].")";
				$result = mysqli_query($conn,$sql);
				$total+=($item["cantidad"]*$item["precio"]);
			}
		}
		$sql2 = "Update pedido set precio=".$total." where idPedido=".$idPedido.";";
		mysqli_query($conn,$sql2);
	}


	public static function guardarItem($idComercio,$nombreItem,$cantidad){
		$conn = DataBase::conection();
		$sql = "select nombre,stock,foto,descripcion,precio,oferta from item where idComercio=".$idComercio." and idComercio is not null";
		$result = mysqli_query($conn,$sql);
		for($i = 0; $i<=$cantidad; $i++){
			this.$listaItems[] = $result->fetch_object();
		}
		$msg = "Se agregaron:".$cantidad." ".$nombreItem." al carrito de compra";
		return $msg;
	}
	public static function traerItems($idComercio){
		$conn = DataBase::conection();
		if ($idComercio) {
			$sql = "select nombre,stock,foto,descripcion,precio,oferta from item where idComercio=".$idComercio." and idComercio is not null";	
		}else{
			$sql = "select nombre,stock,foto,descripcion,precio,oferta from item where idComercio is not null";
		}

		$result = mysqli_query($conn,$sql);
		while ($obj[] = $result->fetch_object()) {
            //no hace nada aca dentro
		}
		return $obj;
	}

	public static function traerPedidos(){
		$conn = DataBase::conection();
		$sql = "select idPedido, precio, tiempoPedido, estadoPedido, idDelivery, idCliente from pedido";	
		$result = mysqli_query($conn,$sql);
		while ($obj[] = $result->fetch_object()) {
            //no hace nada aca dentro
		}
		return $obj;

	}

	public static function tomarPedidos($idUsuario,$idPedido){
		$conn = DataBase::conection();
		if($stmt = $conn->prepare("select * from estadoDelivery where idDelivery=? and estado=?")){
			$estadoPedido = "Disponible";
			$stmt->bind_param("is",$idUsuario,$estadoPedido);
			$stmt->execute();
			mysqli_stmt_store_result($stmt);
			if($stmt->num_rows == 0){
			$validation = false;
			return $validation;
			}
			elseif($stmt = $conn->prepare("update pedido
			set idDelivery =?, estadoPedido= 'Pedido tomado'
			WHERE idPedido = ?;")){
                $stmt->bind_param("ii",$idUsuario,$idPedido);
                $stmt->execute();
				$sql="update estadoDelivery set estado='Ocupado' where idDelivery=".$idUsuario."";
				mysqli_query($conn,$sql);
                $validation = true;
                return $validation;
				}
		}
	}	

	public function realizarPedidos($idUsuario,$idPedido){
		$conn = DataBase::conection();
		//// Si todo sale bien,
			$pedido = $this->consultarPedido($idPedido);
			$pagoADelivery = $pedido->precio * 0.03;
			$pagoAComercio = $pedido->precio * 0.92;
		///////////////////////////////////////////
		if($stmt = $conn->prepare("update pedido
			set idDelivery =?, estadoPedido= 'Realizado', pagoADelivery=$pagoADelivery, pagoAComercio=$pagoAComercio
			WHERE idPedido = ?;")){
                $stmt->bind_param("ii",$idUsuario,$idPedido);
                $stmt->execute();
				$sql="update estadoDelivery set estado='Disponible' where idDelivery=".$idUsuario."";
				mysqli_query($conn,$sql);
                $validation = true;
                return $validation;
            }
		}
	public static function traerPedidosCliente(){
         $conn = DataBase::conection();	
         $sql = "select pedido.idPedido, pedido.precio, tiempoPedido, estadoPedido, u.nombre as NombreCliente, u.direccion as DireccionCliente,
		 c.direccion as DireccionComercio, c.ciudad as CiudadComercio, d.nombre as NombreDelivery, pedido.tiempoRecibo as tiempoRecibo
		 from pedido left join usuario u on pedido.idCliente = u.idUsuario 
		 left join usuario d on d.idUsuario = pedido.idDelivery
		 left join comercio c on pedido.idComercio = c.idComercio
		 where idCliente=".$_SESSION['login']['idUsuario'];	
         $result = mysqli_query($conn,$sql);
         while ($obj[] = $result->fetch_object()) {
             //no hace nada aca dentro
         }
         return $obj;
	}
		public static function traerPedidosCliente2(){
		$conn = DataBase::conection();
		 $sql = "select ci.idPedido idPedido, nombre NombreItem , ci.cantidad Cantidad, item.foto as Foto, item.precio PrecioUnitario
         from item inner join contieneitem ci on ci.IdItem=item.id join pedido p on ci.idPedido = p.idPedido
         where idCliente=".$_SESSION['login']['idUsuario'];
		 $result = mysqli_query($conn,$sql);
         while ($obj[] = $result->fetch_object()) {
			 //no hace nada aca dentro
         }
         return $obj;
	}
	public static function traerPedidosComercio(){
		$conn = DataBase::conection();
		 $sql = "select pedido.idPedido, pedido.precio, tiempoPedido, estadoPedido, u.nombre as NombreCliente, u.direccion as DireccionCliente,
		 c.direccion as DireccionComercio, c.ciudad as CiudadComercio, d.nombre as NombreDelivery, pedido.tiempoRecibo as tiempoRecibo
		 from pedido left join usuario u on pedido.idCliente = u.idUsuario 
		 left join usuario d on d.idUsuario = pedido.idDelivery
		 left join comercio c on pedido.idComercio = c.idComercio
		 where pedido.idComercio=".$_SESSION['login']['idComercio'];
		 $result = mysqli_query($conn,$sql);
         while ($obj[] = $result->fetch_object()) {
			 //no hace nada aca dentro
         }
         return $obj;
	}

	public static function traerPedidosComercio2(){
		$conn = DataBase::conection();
		 $sql = "select ci.idPedido idPedido, nombre NombreItem , ci.cantidad Cantidad, item.foto as Foto, item.precio PrecioUnitario, p.tiempoRecibo as tiempoRecibo
         from item inner join contieneitem ci on ci.IdItem=item.id join pedido p on ci.idPedido = p.idPedido
         where p.idComercio=".$_SESSION['login']['idComercio'];
		 $result = mysqli_query($conn,$sql);
         while ($obj[] = $result->fetch_object()) {
			 //no hace nada aca dentro
         }
         return $obj;
	}

	public static function confirmarPedido($idPedido){
		$conn = DataBase::conection();
		if($stmt = $conn->prepare("update pedido
			set estadoPedido='Pedido sin tomar'
			WHERE idPedido = ?;")){
                $stmt->bind_param("i",$idPedido);
                $stmt->execute();
			}
	}
	public static function reciboPedido($idPedido){
		$conn = DataBase::conection();
		date_default_timezone_set('America/Buenos_Aires');
		$tiempoPedido = date('Y-m-d H:i:s');
		if($stmt = $conn->prepare("update pedido
			set tiempoRecibo=?
			WHERE idPedido = ?;")){
                $stmt->bind_param("si",$tiempoPedido,$idPedido);
                $stmt->execute();
			}
	}

	public static function cancelarPedido($idPedido){
		$conn = DataBase::conection();
		if($stmt = $conn->prepare("delete
			from contieneItem
			WHERE idPedido = ?;")){
                $stmt->bind_param("i",$idPedido);
                $stmt->execute();
			}
		if($stmt2 = $conn->prepare("delete
			from pedido
			WHERE idPedido = ?;")){
                $stmt2->bind_param("i",$idPedido);
                $stmt2->execute();
			}
	}

	public static function traerDeliverysConRecaudacion($mes,$anio){
		$conn = DataBase::conection();
		$sql = "select sum(pagoADelivery) as recaudacion, count(idPedido) as 'pedidosEntregados', idDelivery,nombre,apellido,month(tiempoPedido) as mes,year(tiempoPedido) as anio
				from pedido inner join usuario on pedido.idDelivery = usuario.idUsuario 
				where estadoPedido='Realizado' and liquidadoDelivery='0' and month(tiempoPedido)=$mes and year(tiempoPedido)=$anio 
				group by idDelivery";

		$result = mysqli_query($conn,$sql);
         while ($fila = $result->fetch_object()) {
			 $obj[] = $fila;
         }
         if (!isset($obj)) {
         	return null;
         }
        
        return $obj;
	}

	public static function traerComerciosConRecaudacion($mes,$anio){
		$conn = DataBase::conection();
		$sql = "select sum(pagoAComercio) as recaudacion, count(idPedido) as cantVentas, comercio.idComercio,razonSocial,month(tiempoPedido) as mes,year(tiempoPedido) as anio
				from pedido inner join comercio on pedido.idComercio = comercio.idComercio
				where estadoPedido='Realizado' and liquidadoComercio='0' and month(tiempoPedido)=$mes and year(tiempoPedido)=$anio
				group by pedido.idComercio";

		$result = mysqli_query($conn,$sql);
         while ($fila = $result->fetch_object()) {
			 $obj[] = $fila;
         }
         if (!isset($obj)) {
         	return null;
         }
        
        return $obj;
	}

	public static function liquidarADeliverys($deliverys){
		$conn = DataBase::conection();
		$arrayDeliverys = unserialize($deliverys);
		foreach ($arrayDeliverys as $key => $delivery) {
			$idDelivery = $delivery['idDelivery'];
			$mes = $delivery['mes'];
			$anio = $delivery['anio'];
			$sql = "update pedido set liquidadoDelivery='1' where idDelivery=$idDelivery and estadoPedido='Realizado' and month(tiempoPedido)=$mes and year(tiempoPedido)=$anio";
			mysqli_query($conn,$sql);
		}
	}

	public static function liquidarAComercios($comercios){
		$conn = DataBase::conection();
		$arrayComercios = unserialize($comercios);
		foreach ($arrayComercios as $key => $comercio) {
			$idComercio = $comercio['idComercio'];
			$mes = $comercio['mes'];
			$anio = $comercio['anio'];
			$sql = "update pedido set liquidadoComercio='1' where idComercio=$idComercio and estadoPedido='Realizado' and month(tiempoPedido)=$mes and year(tiempoPedido)=$anio";
			mysqli_query($conn,$sql);
		}
	}

	private function consultarPedido($idPedido){
		$conn = DataBase::conection();
		$sql = "select * from pedido where idPedido=$idPedido";
		$result = mysqli_query($conn,$sql);        
        return $result->fetch_object();
	}


}
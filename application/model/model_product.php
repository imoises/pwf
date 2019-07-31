<?php
require_once 'modelo_config_DB.php';

class Model_Product extends Model{
    public function getList(){
        $productList[] = "Producto1";
        $productList[] = "Producto2";
        return $productList;
    }

    public function traerTodosLosItems(){
        $conn = DataBase::conection();
        $sql = "select idComercio,nombre, stock, foto, oferta, precio, descripcion from item";
        $result = mysqli_query($conn,$sql);
        while ($obj[] = $result->fetch_object()) {
            //no hace nada aca dentro
        }
        return $obj;
    }

    public function traerItemsPorCiudad($ciudad){
        $conn = DataBase::conection();
        $sql = "select item.idComercio,nombre, stock, foto, oferta, precio, descripcion from item inner join comercio on item.IdComercio = comercio.IdComercio where comercio.ciudad='$ciudad'";
        $result = mysqli_query($conn,$sql);
        while ($obj[] = $result->fetch_object()) {
            //no hace nada aca dentro
        }
        return $obj;
    }

    public function traerItemsPorComercio($comercio){
        $conn = DataBase::conection();
        $sql = "select item.idComercio,nombre, stock, foto, oferta, precio, descripcion from item inner join comercio on item.IdComercio = comercio.IdComercio where comercio.razonSocial='$comercio'";
        $result = mysqli_query($conn,$sql);
        while ($obj[] = $result->fetch_object()) {
            //no hace nada aca dentro
        }
        return $obj;
    }
	public function obtenerArrayProducto($idComercio,$nombre,$cantidad){
        $conn = DataBase::conection();
        $sql="SELECT id,nombre,precio,foto,descripcion from item where idComercio=$idComercio and nombre='$nombre'";
        $result= mysqli_query($conn,$sql);
        $rows= mysqli_fetch_assoc($result);
		$precio = intval($rows['precio']);
        $array = array(
			"id"  => $rows['id'],
            "nombre" => $rows['nombre'],
            "cantidad" =>$cantidad,
            "precio" => $precio,
            "foto" => $rows['foto'],
            "descripcion" => $rows['descripcion']
        );
		if(!isset($_SESSION['comercioPedido'])){
            $_SESSION['comercioPedido'] = $idComercio;
        }
        return $array;
    }

    public function traerTodosLosComerciosDeEstaCiudad($ciudad){
        $conn = DataBase::conection();
        $sql = "select * from comercio where ciudad='$ciudad'";
        $result = mysqli_query($conn,$sql);
        while ($valor = $result->fetch_object()) {
            $obj[] =$valor;
        }
        return $obj;
    }

    public function traerItemsDelComercio($idComercio){
        $conn = DataBase::conection();
        $sql = "select * from item where idComercio='$idComercio'";
        $result = mysqli_query($conn,$sql);
        while ($valor = $result->fetch_object()) {
            $obj[] = $valor;
        }
		if(isset($obj)){
        return $obj;
		}
    }
	public function traerCategoriaDeItemsDelComercio($idComercio,$categoria){
        $conn = DataBase::conection();
		switch($categoria){
			case 1:
			$sql = "select * from item where idComercio='$idComercio'";
			break;
			case 2:
			$sql = "select * from item where idComercio='$idComercio' and oferta=true";
			break;
			case 3:
			$sql = "select * from item where idComercio=1 and (oferta=false or oferta is null);";
			break;
		}
        $result = mysqli_query($conn,$sql);
        while ($valor = $result->fetch_object()) {
            $obj[] = $valor;
        }
		if(isset($obj)){
        return $obj;
		}
		return false;
    }
}
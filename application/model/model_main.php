<?php
require_once 'modelo_config_DB.php';

class Model_Main extends Model{
	
	public function traerCiudades(){
		$conn = DataBase::conection();
        $sql = "select ciudad from comercio group by ciudad";
        $result = mysqli_query($conn,$sql);
        while ($valor = $result->fetch_object()) {
             $obj[] = $valor;
        }
        return $obj;
	}

	public function traerComercios(){
		$conn = DataBase::conection();
        $sql = "select razonSocial from comercio group by razonSocial";
        $result = mysqli_query($conn,$sql);
        while ($valor = $result->fetch_object()) {
            $obj[] =$valor;
        }
        return $obj;
	}
	public function crearSessionCiudadComercio($ciudades,$comercios){
        unset( $_SESSION['ciudad'] );
        unset( $_SESSION['comercio'] );
        $_SESSION['ciudades']=$ciudades;
        $_SESSION['comercios']=$comercios;
    }
}
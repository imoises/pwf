<?php
require_once 'modelo_config_DB.php';

class Model_Item extends Model{
    public static function agregarItems($idComercio,$nombre,$stock,$foto,$fototemporal,$oferta,$precio,$descripcion){
		$pathparts = pathinfo($foto);
		$extension=$pathparts['extension'];
		$nuevoNombre = str_replace(" ", "_", $nombre);
		move_uploaded_file($fototemporal,
		"application/resources/img/".$idComercio.$nuevoNombre.".".$extension);
		$foto='../application/resources/img/'.$idComercio.$nuevoNombre.".".$extension;
		$conn = DataBase::conection();
        if($stmt = $conn->prepare("Insert into item (idComercio,nombre,stock,foto,oferta,precio,descripcion)values (?,?,?,?,?,?,?)")){
                $stmt->bind_param("isissds",$idComercio,$nombre,$stock,$foto,
				$oferta,$precio,$descripcion);
                $stmt->execute();
                $validation = true;
                return $validation;
        }
    }

    public static function borrarItems($idComercio,$nombre){
    		
    		$conn = DataBase::conection();
            if($stmt = $conn->prepare("delete from item WHERE nombre = ? and idComercio = ?")){
                    $stmt->bind_param("si",$nombre,$idComercio);
                    $stmt->execute();
                    $validation = true;
                    //echo "<h1>$nombre</h1>"; //para probar si lo recibe bien el nombre del item a eliminar
                    return $validation;
            }
    }


    public static function modificarItems($idComercio,$nombre,$stock,$precio,$oferta,$descripcion){

    		$conn = DataBase::conection();
            if($stmt = $conn->prepare("update item set nombre=?, stock=?, precio=?, oferta=?, 
            descripcion=? where nombre=? and idComercio=?;"))
            {
                    $stmt->bind_param("sidissi",$nombre,$stock,$precio,$oferta,$descripcion,$_SESSION['item']['nombre'],$idComercio);
                    $stmt->execute();
                    $validation = true;
                    $nombreItem=$nombre;
                    return $validation;
            }
    }
	public static function guardarNombreItem($nombre){
		$_SESSION['item']['nombre']=$nombre;
	}
}

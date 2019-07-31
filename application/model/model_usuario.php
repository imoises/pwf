<?php
require_once 'modelo_config_DB.php';

class Model_Usuario extends Model{
	
    public static function logueo($user,$pass){
		
		$conn = DataBase::conection();
        $contraseña = sha1($pass);
		if($stmt = $conn->prepare("Select idUsuario,email,rol,nombre,idComercio,habilDelivery from usuario where email=? and pass=?")){ 
				$stmt->bind_param("ss",$user,$contraseña);
			    $stmt->execute();
                $stmt->bind_result($idUsuario,$email,$rol,$nombre,$idComercio,$habilDelivery);
                $stmt->fetch();

			if($email){
				$_SESSION['login']['idUsuario'] = $idUsuario;
				$_SESSION['login']['rol'] = $rol;
				$_SESSION['login']['email'] = $email;
				$_SESSION['login']['nombre'] = $nombre;
				$_SESSION['login']['idComercio'] = $idComercio;
				if ($habilDelivery==='0') {
					unset( $_SESSION['login'] );
					return false;
				}
				$mensaje = true;
				return $mensaje;
			}
			else{
				$mensaje = false;
				return $mensaje;
				}
		}
	}

	public static function registrar($email,$password,$nombre,$apellido,$telefono,$rol,$direccion,$idComercio,$habilDelivery){
		$conn = DataBase::conection();
		$contraseña = sha1($password);
		if($stmt = $conn->prepare("Insert into usuario (email,pass,nombre,apellido,telefono,rol,direccion,idComercio,habilDelivery)values (?,?,?,?,?,?,?,?,?)")){
			$stmt->bind_param("ssssissis",$email,$contraseña,$nombre,$apellido,$telefono,$rol,$direccion,$idComercio,$habilDelivery);
			$stmt->execute();
			$validacion = true;
			return $validacion;
		}
	}
	
	public static function traerDatos($email){
		$conn = DataBase::conection();
		if($stmt = $conn->prepare("Select pass,nombre,apellido,direccion,telefono,rol from usuario where email=?")){
		$stmt->bind_param("s",$email);
			$stmt->execute();
			$stmt->bind_result($contraseña,$nombre,$apellido,$direccion,$telefono,$rol);
			$stmt->fetch();
			$datosDelUsuario = array("contraseña"=>$contraseña,"nombre"=>$nombre,
			"apellido"=>$apellido,"direccion"=>$direccion,"telefono"=>$telefono,"rol"=>$rol);
			return $datosDelUsuario;
		}
	}
	
	public static function modificarUsuario($email,$password,$nombre,$apellido,$telefono,$direccion){
		$conn = DataBase::conection();
		$password = sha1($password);
		if($stmt = $conn->prepare("Update usuario set pass=?,email=?,nombre=?,apellido=?,telefono=?,direccion=? where email=?")){
			$stmt->bind_param("ssssiss",$password,$email,$nombre,$apellido,$telefono,$direccion,$_SESSION['login']['email']);
			$stmt->execute();
			$validacion = true;
			$_SESSION['login']['email']=$email;
			$_SESSION['login']['nombre']=$nombre;
			return $validacion;		
		}
	}

	public static function modificarComercio($email,$password,$nombre,$apellido,$telefono){
		$conn = DataBase::conection();
		if($stmt = $conn->prepare("Update usuario set pass=?,email=?,nombre=?,apellido=?,telefono=? where email=? and IdComercio=?")){
			$stmt->bind_param("ssssisi",$password,$email,$nombre,$apellido,$telefono,
			$_SESSION['login']['email'],$_SESSION['login']['idComercio']);
			$stmt->execute();
			$validacion = true;
			$_SESSION['login']['email']=$email;
			$_SESSION['login']['nombre']=$nombre;
			return $validacion;
		}
	}

	public static function modificarDelivery($email,$password,$nombre,$apellido,$telefono){
		$conn = DataBase::conection();
		if($stmt = $conn->prepare("Update usuario set pass=?,email=?,nombre=?,apellido=?,telefono=? where email=?")){
			$stmt->bind_param("ssssis",$password,$email,$nombre,$apellido,$telefono,$_SESSION['login']['email']);
			$stmt->execute();
			$validacion = true;
			$_SESSION['login']['email']=$email;
			$_SESSION['login']['nombre']=$nombre;
			return $validacion;
		}
	}

	public static function actor($email){
		$conn = DataBase::conection();
           
		if($stmt = $conn->prepare("Select rol from usuario where email=?")){
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $stmt->bind_result($result);
            $stmt->fetch();

			return $result;       
		} 
	}

	public static function traerTodosLosDeliverysQueHicieronEntregas(){
		$conn = DataBase::conection();
        $sql = "select u.idUsuario, u.nombre, u.apellido, u.telefono, u.email,u. rol, count(idDelivery) as entregas
					from pedido inner join usuario u on u.idUsuario = pedido.idDelivery
					where  estadoPedido='Realizado' and rol='delivery'
					group by pedido.idDelivery;";
        $result = mysqli_query($conn,$sql);
        while ($fila = $result->fetch_object()) {
            $obj[]=$fila;
        }
        if (!isset($obj)) {
	        return false;    	
        }else{
        	return $obj;
        }
	}
	public static function traerTodosLosDeliverysQueNoHicieronEntregas(){
		$conn = DataBase::conection();
        $sql = "select idUsuario,nombre,apellido,telefono,email,rol, idComercio as entregas
				from usuario as us
				where not exists(select * from pedido as pe where exists(select * from usuario as u where us.idUsuario=u.idUsuario and pe.idDelivery=u.idUsuario))  and us.rol='delivery' and us.habilDelivery='1';";
        $result = mysqli_query($conn,$sql);
		$obj = null;
        while ($fila = $result->fetch_object()) {
            $obj[]=$fila;
        }
        if (!isset($obj)) {
	        return false;    	
        }else{
        	return $obj;
        }
	}

	public static function traerLosCincoUsuariosDelComercio($idComercio){
		$conn = DataBase::conection();
        $sql = "select nombre, email, pass from usuario where idComercio=$idComercio";
        $result = mysqli_query($conn,$sql);
        while ($fila = $result->fetch_object()) {
            $obj[]=$fila;
        }
        return $obj;
	}

	public static function activarEstadoDelivery(){
		$conn = DataBase::conection();
		date_default_timezone_set('America/Buenos_Aires');
		$tiempoLogueo = date('Y-m-d H:i:s');
		if($stmt = $conn->prepare("select * from pedido where idDelivery=? and estadoPedido=?")){
			$estadoPedido = "Pedido tomado";
			$stmt->bind_param("is",$_SESSION['login']['idUsuario'],$estadoPedido);
			$stmt->execute();
			mysqli_stmt_store_result($stmt);
			$cant = $stmt->num_rows;
				if($cant != 0){
					$sql = "insert into estadoDelivery (fechaHora,idDelivery,estado,penalizacion) values('".$tiempoLogueo."',
					".$_SESSION['login']['idUsuario']."
					,'Ocupado',0)";
					mysqli_query($conn,$sql);
				}
			else{
			$sql = "insert into estadoDelivery (fechaHora,idDelivery,estado,penalizacion) values('".$tiempoLogueo."',".$_SESSION['login']['idUsuario']."
			,'Disponible',0)";
			mysqli_query($conn,$sql);
			}
		}
	}
	public static function eliminarEstado(){
		$conn = DataBase::conection();
		$sql = "delete from estadoDelivery where idDelivery=".$_SESSION['login']['idUsuario'];
		mysqli_query($conn,$sql);
	}
		public static function traerTodosLosUsuariosTipoDeliveryPendientesAHabilidar(){
		$conn = DataBase::conection();
        $sql = "select * from usuario where rol='delivery' and habilDelivery='0'";
        $result = mysqli_query($conn,$sql);
        while ($fila = $result->fetch_object()) {
            $obj[]=$fila;
        }
        if (!isset($obj)) {
            return false;
        }else{
            return $obj;
        }
	}

	public function darDeAltaDelivery($idUsuario){
		$conn = DataBase::conection();
        $habilDelivery = "1";
        if($stmt = $conn->prepare("Update usuario set habilDelivery=? where idUsuario=?")){
            $stmt->bind_param("si",$habilDelivery,$idUsuario);
            $stmt->execute();

            return true;
        }else{
            return false;
        }
	}

	public function traerUsuario($idUsuario){
		$conn = DataBase::conection();
		if($stmt = $conn->prepare("Select nombre,apellido,email from usuario where idUsuario=?")){
		$stmt->bind_param("i",$idUsuario);
			$stmt->execute();
			$stmt->bind_result($nombre,$apellido,$email);
			$stmt->fetch();
			$datosDelUsuario = array("nombre"=>$nombre,"apellido"=>$apellido,"email"=>$email);
			return $datosDelUsuario;
		}

	}


    public function enviarEmailAltaDelivery($user){
        $nombre = $user['nombre'];
        $email = $user['email'];

        $titulo = "Email de confirmacion APP";
        $mensaje = "Se le ACTIVO SU CUENTA!, Para loguearse ingrese por este link: <a href='localhost/login'> Click acá</a></br>";

        /*Configuracion de variables para enviar el correo*/
        $mail_username="appubya@gmail.com";//Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail_userpassword="appUbYa123";//Tu contraseña de gmail
        $mail_addAddress=$email;//correo electronico que recibira el mensaje
                //$template="application/view/email_template.html"; // $template="email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje
                
                /*Inicio captura de datos enviados por $_POST para enviar el correo */
        $mail_setFromEmail=$email;
        $mail_setFromName=$nombre;
        $txt_message=$mensaje;
        $mail_subject= $titulo;
                
        $this->sendemail($mail_username, $mail_userpassword, $mail_setFromEmail, $mail_setFromName, $mail_addAddress, $txt_message, $mail_subject);//Enviar el mensaje
    }

    public function sendemail($mail_username, $mail_userpassword, $mail_setFromEmail, $mail_setFromName, $mail_addAddress, $txt_message, $mail_subject){
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();                            // Establecer el correo electrónico para utilizar SMTP
        $mail->Host = 'smtp.gmail.com';             // Especificar el servidor de correo a utilizar
        $mail->SMTPAuth = true;                     // Habilitar la autenticacion con SMTP
        $mail->Username = $mail_username;          // Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail->Password = $mail_userpassword;       // Tu contraseña de gmail
        $mail->SMTPSecure = 'tls';                  // Habilitar encriptacion, `ssl` es aceptada
        $mail->Port = 587;                      // Puerto TCP  para conectarse
        $mail->setFrom($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
        $mail->addReplyTo($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
        $message = ($txt_message);
            $mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
            $message = str_replace('{{first_name}}', $mail_setFromName, $message);
            $message = str_replace('{{message}}', $txt_message, $message);
            $message = str_replace('{{customer_email}}', $mail_setFromEmail, $message);
            $mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
        
            $mail->Subject = $mail_subject;
            $mail->msgHTML($message);
            $mail->send();
    }

}

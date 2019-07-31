<?php
require_once 'modelo_config_DB.php';

class Model_Comercio extends Model{

    public function traerDatos($idComercio){
        $conn = DataBase::conection();
        
        if($stmt = $conn->prepare("Select fotoBanner,razonSocial, ciudad, email , direccion from comercio where idComercio=?")){
                $stmt->bind_param("i",$idComercio);
                $stmt->execute();
                $stmt->bind_result($fotoBanner,$razonSocial,$ciudad,$email,$direccion);
                $stmt->fetch();
    			$dato=array("fotoBanner"=>$fotoBanner,"razonSocial"=>$razonSocial,"ciudad"=>$ciudad,"email"=>$email,"direccion"=>$direccion);
    			return $dato;
        }
    }


    public static function traerItems($idComercio){
        $conn = DataBase::conection();
        $sql = "select nombre,stock,foto,descripcion,precio,oferta from item where idComercio=".$idComercio." and idComercio is not null";
        $result = mysqli_query($conn,$sql);
        while ($obj[] = $result->fetch_object()) {
            //no hace nada aca dentro
        }
        return $obj;
    }

    public static function traerTodosLosComercios(){
        $conn = DataBase::conection();
        $sql = "select * from comercio";
        $result = mysqli_query($conn,$sql);
        while ($fila = $result->fetch_object()) {
            $obj[]=$fila;
        }
        return $obj;
    }

    public static function traerTodosLosComerciosHabilitados(){
        $conn = DataBase::conection();
        $sql = "select * from comercio where estado='1'";
        $result = mysqli_query($conn,$sql);
        while ($fila = $result->fetch_object()) {
            $obj[]=$fila;
        }
        return $obj;
    }

    public static function registrarComercio($email,$razonSocial,$ciudad,$direccion,$fotoBanner,$fotoBannerTemporal,$tiempoEntrega){
        $conn = DataBase::conection();
        $estado="0";
        $pathparts = pathinfo($fotoBanner);
        $extension=$pathparts['extension'];
        $nuevoNombre = str_replace(" ", "_", $razonSocial);
        move_uploaded_file($fotoBannerTemporal,
        "application/resources/img/".$nuevoNombre.".".$extension);
        $foto="../application/resources/img/".$nuevoNombre."".".$extension";
        if($stmt = $conn->prepare("Insert into comercio (razonSocial,fotoBanner,ciudad,email,estado,tiempoEntrega,direccion)values (?,?,?,?,?,?,?)")){
            $stmt->bind_param("sssssis",$razonSocial,$foto,$ciudad,$email,$estado,$tiempoEntrega,$direccion);
            $stmt->execute();
            return true;     
        }else{
            return false;
        }  
    }

    public function darDeAltaComercio($idComercio){
        $conn = DataBase::conection();
        $estado = "1";
        if($stmt = $conn->prepare("Update comercio set estado=? where idComercio=?")){
            $stmt->bind_param("si",$estado,$idComercio);
            $stmt->execute();

            $valor = $this->crearCincoUsuariosParaComercio($idComercio);

            return true;
        }else{
            return false;
        }
    }

    private function crearCincoUsuariosParaComercio($idComercio){
        $conn = DataBase::conection();
        $comercio = $this->traerDatos($idComercio);
        $email = $comercio['email'];
        $nombre = $comercio['razonSocial'];
        $rol = "op-comercio";
        $direccion = $comercio['direccion'];
        $paraEnviarPorEmail = array();
        for ($i=0; $i < 5; $i++) { 
            if($stmt = $conn->prepare("Insert into usuario (email,pass,nombre,rol,direccion,idComercio)values (?,?,?,?,?,?)")){
                $password = (uniqid());
                $pass = sha1($password);
                $stmt->bind_param("sssssi",$email,$pass,$nombre,$rol,$direccion,$idComercio);
                $stmt->execute();

                $user = array('nombre' => $nombre,'email' => $email,'pass' => $password );
                array_push($paraEnviarPorEmail, $user);
            }
        }
        $this->enviarEmailLosUsuariosHabilitados($paraEnviarPorEmail);
    }

    public function traerTodosLosComerciosPendientesAHabilidar(){
        $conn = DataBase::conection();
        $sql = "select * from comercio where estado='0'";
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

    public function eliminarComercioPendientesAHabilidar($idComercio){
        $conn = DataBase::conection();
        $sql = "delete from comercio WHERE idComercio=$idComercio";
        $result = mysqli_query($conn,$sql);        
    }

    public function enviarEmailLosUsuariosHabilitados($user){
        $nombre = $user[0]['nombre'];
        $email = $user[0]['email'];

        $titulo = "Email de confirmacion APP";
        $mensaje = "Para loguearse ingrese por este link: <a href='localhost/login'> Click acá</a></br>
                    Estos son los 5 usuarios que se le habilitan: </br>
                        <table border='1'>
                        <tr><td colspan='2'>Usuarios</td></tr>
                        <tr><td>Email</td><td>contraseña</td></tr>
                        <tr><td>".$user[0]['email']."</td><td>".$user[0]['pass']."</td></tr>
                        <tr><td>".$user[1]['email']."</td><td>".$user[1]['pass']."</td></tr>
                        <tr><td>".$user[2]['email']."</td><td>".$user[2]['pass']."</td></tr>
                        <tr><td>".$user[3]['email']."</td><td>".$user[3]['pass']."</td></tr>
                        <tr><td>".$user[4]['email']."</td><td>".$user[4]['pass']."</td></tr>
                        </table>";
        /*foreach ($user as $key => $valor) {
            $mensaje = "email: ".$valor['email']." contraseña: ".$valor['pass']."</br>";
        }*/

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

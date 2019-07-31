<?php 
	$host = "localhost";
	$user = "root";
	$password = "";
	$bd = "pwf_db";

	$conn = new mysqli($host, $user, $password, $bd);

	if ($conn->connect_error) {
		die("fallo la coneccion ".$conn->connect_error);
	}

	$result = mysqli_query($conn,"select idPedido, tiempoPedido, UC.direccion DirC, UO.direccion DirO, precio, estadoPedido
				                  from pedido join usuario UC on pedido.idCliente = UC.idUsuario join usuario UO on pedido.idOpComercio = UO.idUsuario
				                  where estadoPedido='Sin tomar';");

	if ($result) {
		while ($fila = mysqli_fetch_assoc($result)) {
			$data["data"][] = $fila;
	 	}

		echo json_encode($data);
	}else{
		echo "Error";
	}

	$conn->close();

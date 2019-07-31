<?php 

	$host = "localhost";
	$user = "root";
	$password = "";
	$bd = "pwf_db";

	$conn = new mysqli($host, $user, $password, $bd);

	if ($conn->connect_error) {
		die("fallo la coneccion ".$conn->connect_error);
	}

	$sql = "select sum(precio) as recaudacion, month(tiempoPedido) as mes from pedido where estadoPedido='Realizado' group by month(tiempoPedido)";
    $result = mysqli_query($conn,$sql);
    while ($fila = $result->fetch_object()) {
    	$dato[$fila->mes] = (double)$fila->recaudacion;
    }
    
	echo json_encode($dato);

<?php
	$ciudad = $_GET["ciudad"];
	$conexion = mysqli_connect("localhost","root","","pwf_db");
	$sql = "SELECT idComercio, razonSocial FROM comercio WHERE ciudad ='$ciudad' ";
	$resultado = mysqli_query($conexion, $sql);
	echo "<select name='idComercio' id='inputComercio'>";
	while($fila = mysqli_fetch_assoc($resultado)){
	    echo "<option value='" . $fila["idComercio"] . "'>" . $fila["razonSocial"] . "</option>";
	}
	echo "</select>";
?>
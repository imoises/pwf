<?php
class DataBase extends Model{
	static function  conection(){
		$host="localhost";
		$user="root";
		$password="";
		$bd="pwf_db";

		$conn = new mysqli($host, $user, $password, $bd);

		if ($conn->connect_error) {
			die("fallo la coneccion ".$conn->connect_error);
		}

		return $conn;
	}

}
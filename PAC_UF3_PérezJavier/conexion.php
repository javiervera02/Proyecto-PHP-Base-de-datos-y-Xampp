<?php 

	function crearConexion() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "root";
		$pass = "";
		$baseDatos = "pac3_daw";

		$conexion = mysqli_connect($host, $user, $pass, $baseDatos);

		return $conexion;
		
	}


	function cerrarConexion($conexion) {
		
		mysqli_close($conexion);
		
	}


?>
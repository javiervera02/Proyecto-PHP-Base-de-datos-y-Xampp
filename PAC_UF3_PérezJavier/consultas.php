<?php 

	include "conexion.php";

	function tipoUsuario($nombre, $correo){
		$con= crearConexion();

		if (esSuperadmin ($nombre, $correo)) {
			return "superadmin";
		}  
		else {
			$consulta = "SELECT FullName, Email, Enabled FROM user WHERE FullName = '$nombre' and Email = '$correo'";
			$resultado = mysqli_query($con, $consulta);

			cerrarConexion($con);

			if ($datos = mysqli_fetch_array($resultado)) {
				if ($datos["Enabled"] == 0) {
					return "registrado";
				}
				else if ($datos["Enabled"] == 1) {
					return "autorizado";
				}
				else {
					return "no registrado";
				}
			}

		}
	}


	function esSuperadmin($nombre, $correo){
		$con = crearConexion();

		$consulta = "SELECT user.UserID FROM user INNER JOIN setup ON user.UserID = setup.SuperAdmin WHERE user.FullName = '$nombre' and user.Email = '$correo'";

		$resultado = mysqli_query($con, $consulta);

		if ($datos = mysqli_fetch_array($resultado)) {
			return true;
		}
		else {
			return false;
		}



	}


	function getPermisos() {
		$con = crearConexion();

		$consulta = "SELECT Autenticación FROM setup";

		$resultado = mysqli_fetch_assoc(mysqli_query($con, $consulta));

		cerrarConexion($con);

		return $resultado["Autenticación"];
	}


	function cambiarPermisos() {
		$permisos = getpermisos();
		$con = crearConexion();

		if (($permisos == 1)) {
			$consulta = "UPDATE setup SET Autenticación = 0";
		}	else if (($permisos == 0)) {
			$consulta = "UPDATE setup SET Autenticación = 1";
		}
		$resultado = mysqli_query($con, $consulta);
		cerrarConexion($con);
	}


	function getCategorias() {
		$con = crearConexion();

		$consulta = "SELECT CategoryID, Name FROM category";

		$resultado = mysqli_query($con, $consulta);

		cerrarConexion($con);

		return $resultado;	
	}


	function getListaUsuarios() {
		$con = crearConexion();

		$consulta = "SELECT FullName, Email, Enabled FROM user";

		$resultado = mysqli_query($con, $consulta);	

		cerrarConexion($con);

		return $resultado;
	}


	function getProducto($ID) {
		$con = crearConexion();

		$consulta = "SELECT * FROM product WHERE ProductID = $ID";

		$resultado = mysqli_query($con, $consulta);

		cerrarConexion($con);

		return $resultado;	
	}


	function getProductos($orden) {
		$con = crearConexion();

		$consulta = "SELECT product.ProductID, product.Name, product.Cost, product.Price, category.Name as Categoria FROM product INNER JOIN category WHERE product.CategoryID = category.CategoryID ORDER BY $orden";

		$resultado = mysqli_query($con, $consulta);

		cerrarConexion($con);

		return $resultado;	
	}


	function anadirProducto($nombre, $coste, $precio, $categoria) {
		$con = crearConexion();

		$consulta = "INSERT INTO product (Name, Cost, Price, CategoryID)
		VALUES ('$nombre', $coste, $precio, $categoria)";

		$resultado = mysqli_query($con, $consulta);

		cerrarConexion ($con);

		return $resultado;	
	}


	function borrarProducto($id) {
		$con = crearConexion();

		$consulta = "DELETE FROM product WHERE ProductID = $id";

		$resultado = mysqli_query($con, $consulta);

		cerrarConexion($con);

		return $resultado;

	}


	function editarProducto($id, $nombre, $coste, $precio, $categoria) {
		$con = crearConexion();

		$consulta = "UPDATE product SET Name = '$nombre', Cost = $coste, Price = $precio, CategoryID = $categoria WHERE ProductID = $id";

		$resultado = mysqli_query($con, $consulta);

		cerrarConexion($con);

		return $resultado;
	}

?>
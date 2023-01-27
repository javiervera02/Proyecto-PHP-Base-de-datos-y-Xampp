<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>
<body>

	<?php 

		include "funciones.php";

	?>

	<h1>Lista de artículos</h1>

	<?php
	    if (getPermisos() == 1 ) {
		    echo "<a href='formArticulos.php?Anadir'>Añadir producto</a>";
	    }
	?>

	<?php
	    if (!isset($_COOKIE['datos']) or ($_COOKIE['datos'] != "autorizado")) {
	    	echo "No tienes permiso para estar aquí.";
	    } else {
	    	if (!isset($_GET["orden"])) {
	    		$orden = "ProductID";
	    	} else {
	    		$orden = $_GET["orden"];
            }

	        pintaProductos($orden);
        }


    ?>    

	<a href="index.php">Volver al inicio</a>

</body>
</html>
<?php
// Función para conectarnos a la base de datos.
// Return: la conexión o false si hubo un problema.
// Le ponemos de nombre al parámetro "tabla" pero en realidad el valor que le pasamos es el nombre de la base de datos, en este caso "galeria_practica".
function conexion($tabla, $usuario, $pass){ // Nos conectamos a nuestra base de datos
	try {
		$conexion = new PDO("mysql:host=localhost:3307;dbname=$tabla", $usuario, $pass);
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conexion;	
	} catch (PDOException $e) {
		return false;
	}
}

# Funcion para limpiar y convertir datos como espacios en blanco, barras y caracteres especiales en entidades HTML.
# Return: los datos limpios y convertidos en entidades HTML.
function limpiarDatos($datos){
	// Eliminamos los espacios en blanco al inicio y final de la cadena
	$datos = trim($datos);

	// Quitamos las barras / escapandolas con comillas
	$datos = stripslashes($datos);

	// Convertimos caracteres especiales en entidades HTML (&, "", '', <, >)
	$datos = htmlspecialchars($datos);
	return $datos;
}

?>
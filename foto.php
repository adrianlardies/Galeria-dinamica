<?php // Encargado de traer la foto de la bdd (La ruta a la foto que tenemos guardada en la carpeta en nuestro servidor / hosting, no la foto en si).

require 'funciones.php';

$conexion = conexion('galeria_practica', 'root', '');
if (!$conexion) {
	// Terminamos con la ejecucion de la pagina si no pudimos conectar.
	// Normalmente lo que hariamos es redirigir a una pagina de error.
	die();
}


$id = isset($_GET['id']) ? (int)$_GET['id'] : false; // En el $id queremos guardar el valor de id que nos llega, y en formato entero, si no entonces false.

if (!$id) { // Si es false entonces lo enviamos al index. Lo hacemos por seguridad.
	header('Location: index.php');
}


// Traemos la foto
$statement = $conexion->prepare('SELECT * FROM fotos WHERE id = :id');
$statement->execute(array(':id' => $id));

$foto = $statement->fetch();

if (!$foto) { // Si no hay foto significa, por ejemplo, que el usuario introdujo en la url un numero de id de una foto que no existe. Entonces enviamos al usuario al index.
	header('Location: index.php');
}

require 'views/foto.view.php'; // Vinculamos siempre la lógica con la vista, para poder cargarla al entrar en este archivo.

?>
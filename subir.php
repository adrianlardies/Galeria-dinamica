<?php 
require 'funciones.php'; // Debemos acceder a este archivo primero para poder ejecutar a continuación el método contenido en $conexion
$conexion = conexion('galeria_practica', 'root', '');

if (!$conexion) {
	// Terminamos con la ejecución de la página si no pudimos conectar.
	// Normalmente lo que haríamos es redirigir a una página de error (header('Location: error.php');).
	die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES)) { // $_FILES es similar a $_POST, $_GET o $_SESSION, esta variable nos guardará en un arary información que nosotros tengamos de los archivos.
	// Comprobamos con el if si los datos han sido enviados por el método post y si la variable $_FILES no está vacía, si no lo está significa que envió el archivo.
    // La función getimagesize nos devuelve un array de propiedades de la imagen y si no es una imagen devuelve false y un error notice.
	// Podemos utilizar el @ antes de la función para omitir el notice si no es una imagen.
	$check = @getimagesize($_FILES['foto']['tmp_name']); // Con esta información: ($_FILES['foto']['tmp_name']) le estamos pasando el nombre del archivo.
	// tmp_name es un parámetro del array que nos indica una url que es donde se almacena temporalmente la imagen que estamos subiendo.
    if ($check !== false){ // Significa que todo está correcto.
		$carpeta_destino = 'fotos/';
		$archivo_subido = $carpeta_destino . $_FILES['foto']['name'];
		move_uploaded_file($_FILES['foto']['tmp_name'], $archivo_subido); // Subir la foto, 2 parámetros, el nombre del archivo y el destino.

        // Todo esto lo ponemos en la base de datos.
		$statement = $conexion->prepare('INSERT INTO fotos (titulo, imagen, texto) VALUES (:titulo, :imagen, :texto)'); // Placeholders
		$statement->execute(array(
            ':titulo' => $_POST['titulo'],
            ':imagen' => $_FILES['foto']['name'],
            ':texto' => $_POST['texto']
        )); // Reemplazamos los placeholders con la información que queremos.

		header('Location: index.php'); // Una vez hecho queremos redirigir al usuario para que pueda ver las fotos.
	} else {
		$error = "El archivo no es una imagen o el archivo es muy pesado";
	}
}

require 'views/subir.view.php';

?>
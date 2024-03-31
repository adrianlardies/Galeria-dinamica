<?php // Para traer de forma dinámica todas las fotos con las que hemos estado trabajando. Galería dinámica.

require 'funciones.php';
$fotos_por_pagina = 8;

$pagina_actual = (isset($_GET['p']) ? (int)$_GET['p'] : 1); // Ver la página actual en la que estamos.
$inicio = ($pagina_actual > 1) ? $pagina_actual * $fotos_por_pagina - $fotos_por_pagina : 0; // Es lo mismo que hicimos en la práctica de 'Paginación'.

$conexion = conexion('galeria_practica', 'root', '');

if (!$conexion) {
	// Terminamos con la ejecución de la página si no pudimos conectar.
	// Normalmente lo que haríamos es redirigir a una página de error.
	die();
}

// Traemos las fotos de la base de datos.
$statement = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM fotos LIMIT $inicio, $fotos_por_pagina"); // Usamos comillas dobles porque traemos variables. 
// Tenemos que calcular cuántas fotos hay en la bdd, para ello usamos SQL_CALC_FOUND_ROWS.
$statement->execute();
$fotos = $statement->fetchAll(); // El array lo guardamos en una variable.

// Si no hay fotos entonces redirigimos a una página de error.
// También puede ser que no haya fotos porque el usuario intentó acceder a una foto modificando la URL.
if (!$fotos) {
	header('Location: index.php');
}

// Ejecutamos otra consulta para conocer el número de páginas que tendremos.
$statement = $conexion->prepare("SELECT FOUND_ROWS() as total_filas"); // Todas las filas que encontró y que nos las traiga como 'total_filas'.
$statement->execute();
$total_post = $statement->fetch()['total_filas']; // Guardamos el valor de 'total_filas' en una variable.

$total_paginas = ($total_post / $fotos_por_pagina);
$total_paginas = ceil($total_paginas); // Redondeo hacia arriba.

require 'views/index.view.php'; // Para cargar todo el contenido, importante.

?>
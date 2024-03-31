<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> <!-- Siempre lo añadimos antes de los estilos.css -->
	<title>Mi increíble galería en PHP</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<header>
		<div class="contenedor"> <!-- Para centrar todo nuestro contenido. -->
			<h1 class="titulo">Mi increíble galería en PHP y MySQL</h1>
		</div>
	</header>

	<div class="fotos"> <!-- Estructura para las fotos. -->
		<div class="contenedor">
			<?php foreach($fotos as $foto): ?> <!-- La variable fotos está guardando todas las fotos que tenemos, cada foto es un array por lo que $fotos es un array de arrays. -->
			<div class="thumb"> <!-- Foto -->
				<a href="foto.php?id=<?php echo $foto['id']; ?>"> <!-- Le decimos que nos envie al archivo foto.php con el id que tenga el siguiente valor. -->
					<img src="fotos/<?php echo $foto['imagen']; ?>" alt=""> <!-- De la foto queremos traer la 'imagen' que es la ruta (nombre con su extensión). -->
				</a>
			</div>
			<?php endforeach; ?>

				<div class="paginacion"> <!-- Importante hacerlo dentro de nuestra clase contenedor -->
					<!-- Si el usuario está en la página principal entonces no mostramos el enlace a una página anterior. -->
						<?php if ($pagina_actual != 1): ?>
							<a href="index.php?p=<?php echo $pagina_actual -1; ?>" class="izquierda"><i class="fa fa-long-arrow-left"></i> Página anterior</a>
						<?php endif ?> <!-- Dejo un espacio al principio en ' Página anterior' para colocar ahí el icono. Lo añadimos mediante la etiqueta <i>. -->

					<!-- Si el usuario está en la página principal entonces no mostramos el enlace a una página siguiente. -->
						<?php if ($total_paginas != $pagina_actual): ?>
							<a href="index.php?p=<?php echo $pagina_actual +1; ?>" class="derecha">Página siguiente <i class="fa fa-long-arrow-right"></i></a>
						<?php endif ?> <!-- Mismo espacio, pero al final, para colocar el icono correspondiente. -->
				</div>
		</div>
	</div>

	<footer>
		<p class="copyright">Galería creada por Adrián Lardiés Utrilla</p>
	</footer>
</body>
</html>
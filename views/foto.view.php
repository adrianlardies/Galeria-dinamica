<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<title>Mi increíble galería en PHP</title>
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<header>
		<div class="contenedor">
			<h1 class="titulo">Foto: <?php if(!empty($foto['titulo'])){ 
                echo $foto['titulo'];
            } else { 
                echo $foto['imagen']; 
            } ?></h1>
            <!-- Si la foto no está vacía, el título, entonces lo vamos a utilizar. Sino, si no tiene título, usamos el nombre de la foto, que es el valor 'imagen' de la tabla. -->
		</div>
	</header>

	<div class="contenedor">
		<div class="foto">
			<img src="fotos/<?php echo $foto['imagen'] ?>" alt="">
			<p class="texto"><?php echo $foto['texto']; ?></p>
			<a class="regresar" href="index.php"><i class="fa fa-long-arrow-left"></i> Regresar</a>
		</div>
	</div>

	<footer>
		<p class="copyright">Galería creada por Adrián Lardiés Utrilla</p>
	</footer>
</body>
</html>
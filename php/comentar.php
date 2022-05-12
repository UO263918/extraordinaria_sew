<!DOCTYPE html>
<html lang = "es">
    <head>
        <title>Hamburguesería Bajo Locus Index</title>
        <meta charset = "UTF-8"/>
		<meta name="author-name" content="Raúl López Calvo UO263918"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta name="keywords" content="Hamburguesería, Comida Rápida, Comida Vegana, Proyecto SEW, Patatas Fritas, Aros de Cebolla, Hamburguesas, Ternera, Pollo, Carne de Angus"/>
        <meta name="description" content="Hamburguesería en la cual se podrán pedir distintos tipos de hamburguesas y de complementos"/> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="estilos/grid.css"/>
		<link rel="stylesheet" type="text/css" href="estilos/estilo.css"/>
    </head>
    <body>
		<header>
			<a href="index.html" title="Ir a la página de inicio">
				<img src="imagenes/hamburguesaIcono.png" alt="Pizzeria EII"/>
			</a>
        </header>
		<nav>
			<ul>
				<li><a title="Introduccion" accesskey="I" href="index.html">Introduccion</a></li>
				<li><a title="Recomendaciones" accesskey="R" href="recomendaciones.html">Recomendaciones</a></li>
				<li><a title="Opciones Veganas/Vegetarianas" accesskey="V" href="vegano.html">Opciones Veganas o Vegetarianas</a></li>
				<li><a title="Nuestras Hamburguesas" accesskey="H" href="xml/hamburguesas.html">Nuestras Hamburguesas</a></li>
				<li><a title="Nuestros Complementos" accesskey="C" href="xml/complementos.html">Nuestros Complementos</a></li>
				<li><a title="Calculadora de KiloCalorias" accesskey="K" href="js/calculadoraDeCalorias.html">Calculadora de KiloCalorias</a></li>
				<li><a title="¿Dónde Encontrarnos?" accesskey="D" href="dondeEncontrarnos.html">¿Dónde Encontrarnos?</a></li>
				<li><a title="Realizar un Pedido" accesskey="P" href="pedido.html">Realizar un Pedido</a></li>
			</ul>
		</nav>
		<main>
			<?php
			//Me conecto a la base de datos con las creedenciales ya creadas
			$baseDeDatos = new mysqli('localhost', 'DBUSER2021', 'DBPSWD2021');

			//Creo la base de datos proyecto_sew
			$cadenaSQL = "CREATE DATABASE IF NOT EXISTS proyecto_sew COLLATE utf8_spanish_ci";

			//Si al ejecutar la query de creacion, la cosa va bien, creo la tabla correspondiente
			if ($baseDeDatos->query($cadenaSQL) === TRUE) {

				//Al crearse correctamente, la base de datos puede apuntar a la base de datos del proyecto
				$baseDeDatos->select_db("proyecto_sew");
				
				//Creo la tabla de los comentarios
				$consultaCrearTabla = "CREATE TABLE IF NOT EXISTS comentarios (id INT NOT NULL AUTO_INCREMENT,
				nombre VARCHAR(30) NOT NULL, apellido VARCHAR(30) NOT NULL, dni_usuario VARCHAR(9) NOT NULL,
				comentario VARCHAR(500) NOT NULL, PRIMARY KEY (id), FOREIGN KEY (dni_usuario) REFERENCES usuarios(dni))";

				//Si se crea correctamente la tabla, introduzco el comentario del usuario
				if ($baseDeDatos->query($consultaCrearTabla) === TRUE) {

					//Insertar comentario
					$baseDeDatos->select_db("comentarios");
					
					//Creo la consulta para introducir el comentario
					$consultaPre =
						$baseDeDatos->prepare("INSERT INTO comentarios(nombre,apellido,dni_usuario,comentario) VALUES (?,?,?,?)");
					
					//Introduzco los valores sacados del formulario
					$consultaPre->bind_param('ssss',
						$_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["comentario"]);
					
					//Ejecuto la consulta
					$consultaPre->execute();
					
					//Cierro la consulta y muestro un mensaje diciendo que el comentario ha sido introducido correctamente
					$consultaPre->close();
					
					echo "<h3>Su comentario ha sido introducido con exito</h3>";


				} else {
					echo "<p>Se ha producido un error creando la tabla de comentarios.</p>";
					exit();
				}

			} else {
				echo "<p>Se ha producido un error creando la base de datos.</p>";
				exit();
			}

			//Cerramos la conexion cuando finalicen todos los procesos
			$baseDeDatos->close();
			?>
		</main>
		<footer>
            <div id="contacto">
				<span class="contacto_footer">
					Responsable de la Hamburguesería:
					<a href="mailto:uo263918@uniovi.es">Raúl López Calvo</a>
				</span>
			</div>
			<div class="validaciones">
				<a href="https://validator.w3.org/check?uri=referer"><img src="imagenes/HTML5.png" alt=" HTML5 Válido!"/></a>
				<a href=" http://jigsaw.w3.org/css-validator/check/referer "><img src="imagenes/CSS3.png" alt="CSS Válido" height="63" width="64" /></a>
			</div>
		</footer>
	</body>
</html>

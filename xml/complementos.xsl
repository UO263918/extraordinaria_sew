<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes"/>   
        <xsl:template match="/">
            <html lang = "es" xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<title>Hamburguesería Bajo Locus Hamburguesas</title>
					<meta charset = "UTF-8"/>
					<meta name="author-name" content="Raúl López Calvo UO263918"/>
					<meta name="viewport" content="width=device-width, initial-scale=1.0" />
					<meta http-equiv="X-UA-Compatible" content="ie=edge" />
					<meta name="keywords" content="Hamburguesería, Comida Rápida, Comida Vegana, Proyecto SEW, Patatas Fritas, Aros de Cebolla, Hamburguesas, Ternera, Pollo, Carne de Angus"/>
					<meta name="description" content="Hamburguesería en la cual se podrán pedir distintos tipos de hamburguesas y de complementos"/> 
					<link rel="stylesheet" type="text/css" href="../estilos/grid.css"/>
					<link rel="stylesheet" type="text/css" href="../estilos/estilo.css"/>
				</head>
                <body>
					<header>
						<a href="index.html" title="Ir a la página de inicio">
							<img src="../imagenes/hamburguesaIcono.png" alt="Pizzeria EII"/>
						</a>
					</header>
					<nav>
						<ul>
							<li><a title="Introduccion" accesskey="I" href="../index.html">Introduccion</a></li>
							<li><a title="Recomendaciones" accesskey="R" href="../recomendaciones.html">Recomendaciones</a></li>
							<li><a title="Opciones Veganas/Vegetarianas" accesskey="V" href="../vegano.html">Opciones Veganas o Vegetarianas</a></li>
							<li><a title="Nuestras Hamburguesas" accesskey="H" href="hamburguesas.html">Nuestras Hamburguesas</a></li>
							<li><a title="Calculadora de KiloCalorias" accesskey="K" href="../calculadora.html">Calculadora de KiloCalorias</a></li>
							<li><a title="¿Dónde Encontrarnos?" accesskey="D" href="../localizacion.html">¿Dónde Encontrarnos?</a></li>
							<li><a title="Realizar un Pedido" accesskey="P" href="../pedido.html">Realizar un Pedido</a></li>
							<li><a title="Opiniones y Comentarios" accesskey="O" href="../comentarios.html">Opiniones y Comentarios</a></li>
						</ul>
					</nav>
					<main class="complementos">
						<h2>Nuestros Complementos</h2>
                        <xsl:for-each select="complementos/complemento">
                            <section>
                                <h2><xsl:value-of select="titulo"/></h2>
								<figure>
									<img alt="Imagen del Complemento" src="{foto}" height ="600" width="600"/>
									<figcaption>Imagen del Complemento</figcaption>
								</figure>
                                <p>
                                    <xsl:value-of select="descripcion"/>
                                </p>
                                <h3>Precio:</h3>
                                <p>
                                    <xsl:value-of select="precio"/>
                                </p>        
                                <h3>Calorias:</h3>
                                <p>
                                    <xsl:value-of select="kcal"/>
                                </p> 
                                <h3>Valoración:</h3>
                                <p>
                                    <xsl:value-of select="valoracion"/>
                                </p> 
								<h3>Alérgenos:</h3>
                                <xsl:for-each select="alergenos/alergeno">
                                    <p>
                                        <xsl:value-of select="."/>
                                    </p>
                                </xsl:for-each>
                                <h3>Recomendación:</h3>
                                <p>
                                    <xsl:value-of select="recomendacion"/>
                                </p> 
                            </section>
                        </xsl:for-each>
                    </main>
                </body>
            </html>
        </xsl:template>
</xsl:stylesheet>
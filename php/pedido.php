<?php
header("Content-Type: application/json", true);
//Me conecto a la base de datos con las creedenciales ya creadas
$baseDeDatos = new mysqli('localhost', 'DBUSER2021', 'DBPSWD2021');

//Creo la base de datos proyecto_sew
$cadenaSQL = "CREATE DATABASE IF NOT EXISTS proyecto_sew COLLATE utf8_spanish_ci";

//Si al ejecutar la query de creacion, la cosa va bien, creo la tabla correspondiente
if ($baseDeDatos->query($cadenaSQL) === TRUE) {

	//Al crearse correctamente, la base de datos puede apuntar a la base de datos del proyecto
    $baseDeDatos->select_db("proyecto_sew");

	//Creo la tabla de los comentarios
    $consultaCrearTabla = "CREATE TABLE IF NOT EXISTS Pedidos (id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(30) NOT NULL, apellido VARCHAR(30) NOT NULL, dni_usuario VARCHAR(9) NOT NULL,
        comida VARCHAR(30) NOT NULL, precio  VARCHAR(30) NOT NULL, PRIMARY KEY (id), 
		FOREIGN KEY (dni_usuario) REFERENCES usuarios(dni))";

    //Si se crea bien la tabla de user, creo la de pizzas
    if ($baseDeDatos->query($consultaCrearTabla) === TRUE) {

        //Insertar el pedido
        $baseDeDatos->select_db("Pedidos");

		//Creo la consulta para introducir el pedido
        $consultaPre =
            $baseDeDatos->prepare("INSERT INTO Pedidos(nombre,apellido,dni_usuario,comida,precio) VALUES (?,?,?,?,?)");

		//Obtengo los valores del pedido y del usuario
        $pedidoUsuario = json_decode($_POST['datosUsuario']);
        $pedidoComida = json_decode($_POST['pedido']);

		/*Recorro el bucle de comidas seleccionadas y para cada comida se le mete el usuario y el precio para añadirlo
		/al pedido*/
        foreach ($pedidoComida as $comida) {
            $consultaPre->bind_param('sssss',
                $pedidoUsuario->nombre, $pedidoUsuario->apellido, $pedidoUsuario->dni_usuario,
                $comida->nombre, $comida->precio);
            $consultaPre->execute();
        }
		//Cerramos la conexion cuando finalicen todos los procesos
        $consultaPre->close();

        echo json_encode("Su pedido ha sido tramitado correctamente, disfrute de nuestro servicio");

    } else {
        echo json_encode("Se ha producido un error con la tabla de pedidos, disculpe las molestias");
    }
} else {
    echo json_encode("Se ha producido un error creando la base de datos, disculpe las molestias");
}
?>
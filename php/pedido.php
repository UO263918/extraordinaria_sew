<?php
class OrderManager{
	
	protected $servername;
    protected $username;
    protected $password;
	protected $connectionStatus;
	protected $dataBaseName;
    protected $connection;
	protected $primeraVez;
			
	public function __construct(){
        $this->servername ="localhost";
        $this->username = "DBUSER2021";
        $this->password = "DBPSWD2021";
		$this->connectionStatus ="";
		$this->dataBaseName = "proyecto_sew";
		$this->currentResult = "";
		$this->primeraVez = true;
    }

    public function crearConexion(){

        $baseDeDatos = new mysqli("localhost","DBUSER2021","DBPSWD2021","proyecto_sew");

        if($baseDeDatos->connect_errno){
            $this->connectionStatus =  "<p>Error de conexion: " . $baseDeDatos->connect_error . "</p>";
           return null;
        }else{
            $this->connectionStatus = "<p>Conexion establecida con exito</p>";
            $this->connection = $baseDeDatos;
			if($this->primeraVez){
				$this->crearBaseDeDatos();
				$this->primeraVez = false;
			}
            return $baseDeDatos;
        }
    }
	
	public function crearBaseDeDatos(){
		$this->connection->select_db($this->dataBaseName);

        if($this->connection == null){
            $this->currentResult = 'Error en la conexion';
            return;
        }

        //Creo la tabla de los pedidos
		$consultaCrearTabla = "CREATE TABLE IF NOT EXISTS Pedidos (id INT NOT NULL AUTO_INCREMENT,
			nombre VARCHAR(30) NOT NULL, apellido VARCHAR(30) NOT NULL, dni_usuario VARCHAR(9) NOT NULL,
			comida VARCHAR(30) NOT NULL, precio  VARCHAR(30) NOT NULL, PRIMARY KEY (id), 
			FOREIGN KEY (dni_usuario) REFERENCES usuarios(dni))";
		
		if ($baseDeDatos->query($consultaCrearTabla) === FALSE) {
			echo "<p>Se ha producido un error creando la tabla de pedidos.</p>";
			exit();
		}
	}
	
	public function ejecutarPedido(){

        $this->connection =  $this->crearConexion();
        
		//Insertar comentario
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
			
		//Cerramos la conexion cuando finalicen todos los procesos
		$baseDeDatos->close();
        $this->connection->close();
    }
}

if(!isset($_SESSION['pedir'])){
    

    $em = new ComentManager();
    $em->crearConexion();
    $_SESSION['pedir'] = $em;
    
}

if(count($_POST)>0){
    $em = $_SESSION['pedir'];
    if(isset($_POST['enviar']))  $em->ejecutarPedido();
    $_SESSION['pedir'] = $em;
}

?>
<?php

class ComentManager{
	
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

        //Creo la tabla de los comentarios
		$consultaCrearTabla = "CREATE TABLE comentarios (id INT NOT NULL AUTO_INCREMENT,
		nombre VARCHAR(30) NOT NULL, apellido VARCHAR(30) NOT NULL, dni_usuario VARCHAR(9) NOT NULL,
		comentario VARCHAR(500) NOT NULL, PRIMARY KEY (id), FOREIGN KEY (dni_usuario) REFERENCES usuarios(dni))";
		
		if ($baseDeDatos->query($consultaCrearTabla) === FALSE) {
			echo "<p>Se ha producido un error creando la tabla de comentarios.</p>";
			exit();
		}
	}
	
	public function ejecutarComentario(){

        $this->connection =  $this->crearConexion();
        
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
		
		//Cerramos la conexion cuando finalicen todos los procesos
		$baseDeDatos->close();
        $this->connection->close();
    }
}

if(!isset($_SESSION['comentar'])){
    

    $em = new ComentManager();
    $em->crearConexion();
    $_SESSION['comentar'] = $em;
    
}

if(count($_POST)>0){
    $em = $_SESSION['comentar'];
    if(isset($_POST['enviar']))  $em->ejecutarComentario();
    $_SESSION['comentar'] = $em;
}
?>

<?php 
	class usuario_Model extends mysql{

		//VARIABLES  - ENTIDADES DE LA TABLA USUARIOS
		public $stridUsuario;
		public $stridRol;
		public $strUsuario; 
		public $strClave; 
		public $strNombres; 
		public $strApellidos;
		public $intDNI; 
		public $strFechanac; 
		public $intCel;
		public $strFoto;
		public $strCorreo;
		public $strDireccion;
		public $strDireccion2;
		public $strReferencia;
		public $intEstado;

		public function __construct(){

			parent::__construct();

		}

		public function ListarUsuarios(){
			$whereAdmin = "";
			if($_SESSION['idusuario'] != 'US00000001'){
				$whereAdmin = " WHERE us.idusuario != 'US00000001' ";
			}

			//$sql = "CALL SPU_USUARIO_LISTAR()";

			$sql =  "SELECT us.idusuario,us.nombres,us.apellidos,us.nombreusuario,
							us.correo,us.celular,r.nombrerol,us.estado FROM usuarios us
					INNER JOIN roles r ON r.idrol = us.idrol" .$whereAdmin;

			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function SeleccionarUsuario(string $idusuario){
			$this->stridUsuario = $idusuario;
			$sql = "CALL SPU_USUARIO_SELECCIONAR('{$this->stridUsuario}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function RegistrarUsuario(string $idrol, string $nombreusuario, string $clave, string $nombres, 
			string $apellidos, int $dni, string $fechanac, int $celular, string $foto, string $correo, string $direc, string $direc2, string $refer,  int $estado){

			$return = 0;
			$this->stridRol = $idrol;
			$this->strUsuario = $nombreusuario;
			$this->strClave = $clave;
			$this->strNombres = $nombres;
			$this->strApellidos = $apellidos;
			$this->intDNI = $dni;
			$this->strFechanac = $fechanac;
			$this->intCel = $celular;
			$this->strFoto = $foto;
			$this->strCorreo = $correo;
			$this->strDireccion = $direc;
			$this->strDireccion2 = $direc2;
			$this->strReferencia = $refer;
			$this->intEstado = $estado;

			$sql_consultar = "SELECT * FROM usuarios WHERE correo = '{$this->strCorreo}' or dni = '{$this->intDNI}'";
			$resultado = $this->Listar($sql_consultar);

			if(empty($resultado)){
				$sql  = "CALL SPU_USUARIO_REGISTRAR(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->stridRol,
        						$this->strUsuario,
        						$this->strClave,
        						$this->strNombres,
        						$this->strApellidos,
        						$this->intDNI,
        						$this->strFechanac,
        						$this->intCel,
        						$this->strFoto,
        						$this->strCorreo,
        						$this->strDireccion,
        						$this->strDireccion2,
        						$this->strReferencia,
        						$this->intEstado);

	        	$insertarDato = $this->Registrar($sql,$arrData);
	        	$return = $insertarDato;
			}else{
				$return = "existe";
			}

	        return $return;
		}

		public function ModificarUsuario(string $idusuario,string $idrol, string $nombreusuario, string $clave,string $nombres,string $apellidos, int $dni, string $fechanac, int $celular, string $foto, string $correo,string $direc, string $direc2, string $refer, int $estado){

			$this->stridUsuario = $idusuario;
			$this->stridRol = $idrol;
			$this->strUsuario = $nombreusuario;
			$this->strClave = $clave;
			$this->strNombres = $nombres;
			$this->strApellidos = $apellidos;
			$this->intDNI = $dni;
			$this->strFechanac = $fechanac;
			$this->intCel = $celular;
			$this->strFoto = $foto;
			$this->strCorreo = $correo;
			$this->strDireccion = $direc;
			$this->strDireccion2 = $direc2;
			$this->strReferencia = $refer;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM usuarios WHERE (correo = '{$this->strCorreo}' AND idusuario != '{$this->stridUsuario}')
					OR (dni = '{$this->intDNI}' AND idusuario != '{$this->stridUsuario}')";
			
			$resultado = $this->Listar($sql);

			if(empty($resultado)){
				
				if($this->strClave  != ""){
					$sql = "CALL SPU_USUARIO_MODIFICAR(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					$arrData = array(	$this->stridUsuario,
										$this->stridRol,
										$this->strUsuario,
										$this->strClave,
										$this->strNombres,
										$this->strApellidos,
										$this->intDNI,
										$this->strFechanac,
										$this->intCel,
										$this->strFoto,
										$this->strCorreo,
										$this->strDireccion,
        								$this->strDireccion2,
        								$this->strReferencia,
										$this->intEstado
									);
				}else{
					$sql = "CALL SPU_USUARIO_MODIFICAR_SINCLAVE(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					$arrData = array(	$this->stridUsuario,
										$this->stridRol,
										$this->strUsuario,
										$this->strNombres,
										$this->strApellidos,
										$this->intDNI,
										$this->strFechanac,
										$this->intCel,
										$this->strFoto,
										$this->strCorreo,
										$this->strDireccion,
        								$this->strDireccion2,
        								$this->strReferencia,
										$this->intEstado
									);
				}
				$resultado = $this->Modificar($sql,$arrData);
			}else{
				$resultado = "existe";
			}
			return $resultado;

		}

		public function EliminarUsuario(string $idusuario){
			$this->stridUsuario = $idusuario;
			$sql = "CALL SPU_USUARIO_ELIMINAR('{$this->stridUsuario}')";
			$request = $this->Eliminar($sql);
			return $request;
		}

	}

 ?>
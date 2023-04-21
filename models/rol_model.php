<?php 
	class rol_Model extends mysql{

		//VARIABLES  - ENTIDADES DE LA TABLA ROL
		public $strIdRol;
		public $strNombreRol;
		public $strDescripcion;
		public $intEstado;

		public function __construct(){
			parent::__construct();
		}

		public function ListarRoles(){
			$whereAdmin = "";
			if($_SESSION['idusuario'] != 'US00000001'){
				$whereAdmin = " WHERE idrol != 'RL00000001' ";
			}

			$sql = "SELECT * FROM roles".$whereAdmin;
			//$sql = "CALL SPU_ROL_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function SeleccionarRol(string $idrol){
			$this->strIdRol = $idrol;
			$sql = "SELECT * FROM roles WHERE idrol = '{$this->strIdRol}' ";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function RegistrarRoles(string $nombrerol, string $descripcion, int $estado){

			$return = "";
			$this->strNombreRol = $nombrerol;
			$this->strDescripcion = $descripcion;
			$this->intEstado = $estado;

			//CONSULTAMOS SI EXISTE EL NOMBRE DEL ROL
			$sql_consultar = "SELECT * FROM roles where nombrerol = '{$this->strNombreRol}' ";
			$resultado = $this->Listar($sql_consultar);

			//SI EL RESULTADO ES VACIO - NO ENCONTRO OTRO NOMBRE IGUAL
			if(empty($resultado)){
				$sql = "CALL SPU_ROL_REGISTRAR(?,?,?)";
				//$sql = "INSERT INTO roles(nombrerol,descriprol,estado) VALUES(?,?,?)";
				$arrData = array($this->strNombreRol, $this->strDescripcion, $this->intEstado);
				$insertarDato = $this->Registrar($sql, $arrData);
				$return = $insertarDato;
			}else{
				$return = "existe";
			}

			return $return;

		}


		public function ModificarRoles( string $idrol ,string $nombrerol, string $descripcion, int $estado){

			$this->strIdRol = $idrol;
			$this->strNombreRol = $nombrerol;
			$this->strDescripcion = $descripcion;
			$this->intEstado = $estado;

			//CONSULTAMOS SI EXISTE EL NOMBRE DEL ROL y ID
			$sql_consultar = "SELECT * FROM roles where nombrerol = '{$this->strNombreRol}' AND idrol != '{$this->strIdRol}'";
			$resultado = $this->Listar($sql_consultar);

			//SI EL RESULTADO ES VACIO - NO ENCONTRO OTRO NOMBRE IGUAL
			if(empty($resultado)){
				$sql = "CALL SPU_ROL_MODIFICAR(?,?,?,?)";
				$arrData = array($this->strIdRol,$this->strNombreRol, $this->strDescripcion, $this->intEstado);
				$resultado = $this->Modificar($sql, $arrData);
			}else{
				$resultado = "existe";
			}

			return $resultado;

		}

		public function EliminarRoles(string $idrol){
			
			$this->strIdRol = $idrol;
			$sql = "SELECT * FROM usuarios WHERE idrol = '{$this->strIdRol}'";
			$resultado = $this->Listar($sql);
			
			if(empty($resultado)){
				$sql = "DELETE FROM roles WHERE idrol ='{$this->strIdRol}'";
				$resultado = $this->Eliminar($sql);

				if($resultado){

					$resultado = 'ok';	

				}else{
					$resultado = 'error';
				}
			}else{
				$resultado = 'existe';
			}
			return $resultado;
		}

	}

 ?>
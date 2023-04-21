<?php 
	class clasificacion_Model extends mysql{

		public $stridClasificacion;
		public $strClasificacion; 
		public $intEstado;

		public function __construct(){

			parent::__construct();

		}

		public function ListarClasificacion(){

			$sql = "CALL SPU_CLASIFICACION_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function SeleccionarClasificacion(string $idclasificacion){
			$this->stridClasificacion = $idclasificacion;
			$sql = "CALL SPU_CLASIFICACION_SELECCIONAR('{$this->stridClasificacion}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function RegistrarClasificacion(string $clasificacion,int $estado){
			$this->strClasificacion = $clasificacion;
			$this->intEstado = $estado;
			$return = 0;

			$sql_consultar = "SELECT * FROM clasificaciones WHERE clasificacion = '{$this->strClasificacion}'";
			$resultado = $this->Listar($sql_consultar);

			if(empty($resultado)){
				$sql  = "CALL SPU_CLASIFICACION_REGISTRAR(?,?)";
	        	$arrData = array($this->strClasificacion, $this->intEstado);
	        	$insertarDato = $this->Registrar($sql,$arrData);
	        	$return = $insertarDato;
			}else{
				$return = "existe";
			}

	        return $return;
		}

		public function ModificarClasificacion(string $idclasificacion,string $clasificacion,int $estado){

			$this->stridClasificacion = $idclasificacion;
			$this->strClasificacion = $clasificacion;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM clasificaciones WHERE clasificacion = '{$this->strClasificacion}' AND idclasificacion != '{$this->stridClasificacion}'";
			
			$resultado = $this->Listar($sql);

			if(empty($resultado)){
	
				$sql = "CALL SPU_CLASIFICACION_MODIFICAR(?,?,?)";
				$arrData = array($this->stridClasificacion, $this->strClasificacion, $this->intEstado);
				$resultado = $this->Modificar($sql,$arrData);
			}else{
				$resultado = "existe";
			}
			return $resultado;

		}

		public function EliminarClasificacion($idclasificacion){
			$this->stridClasificacion = $idclasificacion;
			$sql = "CALL SPU_CLASIFICACION_ELIMINAR('{$this->stridClasificacion}')";
			$request = $this->Eliminar($sql);
			return $request;
		}

	}

 ?>
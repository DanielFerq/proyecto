<?php 
	class presentacion_Model extends mysql{

		public $strIdPresentacion;
		public $strPresentacion; 
		public $strDesCorta; 
		public $intEstado;

		public function __construct(){

			parent::__construct();

		}

		public function ListarPresentaciones(){

			$sql = "CALL SPU_PRESENTACION_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function SeleccionarPresentacion(string $idpresentacion){
			$this->strIdPresentacion = $idpresentacion;
			$sql = "CALL SPU_PRESENTACION_SELECCIONAR('{$this->strIdPresentacion}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function RegistrarPresentacion(string $presentacion,string $descorta,int $estado){
			$this->strPresentacion = $presentacion;
			$this->strDesCorta = $descorta;
			$this->intEstado = $estado;
			$return = 0;

			$sql_consultar = "SELECT * FROM Presentaciones WHERE presentacion = '{$this->strPresentacion}'";
			$resultado = $this->Listar($sql_consultar);

			if(empty($resultado)){
				$sql  = "CALL SPU_PRESENTACION_REGISTRAR(?,?,?)";
	        	$arrData = array($this->strPresentacion,$this->strDesCorta, $this->intEstado);
	        	$insertarDato = $this->Registrar($sql,$arrData);
	        	$return = $insertarDato;
			}else{
				$return = "existe";
			}

	        return $return;
		}

		public function ModificarPresentacion(string $idpresentacion,string $presentacion,string $descorta,int $estado){

			$this->strIdPresentacion = $idpresentacion;
			$this->strPresentacion = $presentacion;
			$this->strDesCorta = $descorta;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM presentaciones WHERE presentacion = '{$this->strPresentacion}' AND idpresentacion != '{$this->strIdPresentacion}'";
			
			
			$resultado = $this->Listar($sql);

			if(empty($resultado)){
	
				$sql = "CALL SPU_PRESENTACION_MODIFICAR(?,?,?,?)";
				$arrData = array($this->strIdPresentacion,
								$this->strPresentacion,
								$this->strDesCorta, 
								$this->intEstado);
				$resultado = $this->Modificar($sql,$arrData);
			}else{
				$resultado = "existe";
			}
			return $resultado;

		}

		public function EliminarPresentacion($idpresentacion){
			$this->strIdPresentacion = $idpresentacion;
			$sql = "CALL SPU_PRESENTACION_ELIMINAR('{$this->strIdPresentacion}')";
			$request = $this->Eliminar($sql);
			return $request;
		}

	}

 ?>
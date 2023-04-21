<?php 
	class moneda_Model extends mysql{

		public $stridmoneda;
		public $strmoneda; 
		public $intEstado;

		public function __construct(){

			parent::__construct();

		}

		public function Listarmoneda(){
			$sql = "CALL SPU_moneda_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function Seleccionarmoneda(string $idmoneda){
			$this->stridmoneda = $idmoneda;
			$sql = "CALL SPU_moneda_SELECCIONAR('{$this->stridmoneda}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function Registrarmoneda(string $moneda,int $estado){
			$this->strmoneda = $moneda;
			$this->intEstado = $estado;
			$return = 0;

			$sql_consultar = "SELECT * FROM monedas WHERE nombremoneda = '{$this->strmoneda}'";
			$resultado = $this->Listar($sql_consultar);

			if(empty($resultado)){
				$sql  = "CALL SPU_moneda_REGISTRAR(?,?)";
	        	$arrData = array($this->strmoneda, $this->intEstado);
	        	$insertarDato = $this->Registrar($sql,$arrData);
	        	$return = $insertarDato;
			}else{
				$return = "existe";
			}

	        return $return;
		}

		public function Modificarmoneda(string $idmoneda, string $nombremoneda, int $estado){

			$this->stridmoneda = $idmoneda;
			$this->strmoneda = $nombremoneda;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM monedas WHERE nombremoneda = '{$this->strmoneda}' AND idmoneda != '{$this->stridmoneda}'";
			
			$resultado = $this->Listar($sql);

			if(empty($resultado)){
	
				$sql = "CALL SPU_moneda_MODIFICAR(?,?,?)";
				$arrData = array($this->stridmoneda,$this->strmoneda,$this->intEstado);
				$resultado = $this->Modificar($sql,$arrData);
			}else{
				$resultado = "existe";
			}
			return $resultado;

		}

		public function Eliminarmoneda(string $idmoneda){
			$this->stridmoneda = $idmoneda;
			$sql = "CALL SPU_moneda_ELIMINAR('{$this->stridmoneda}')";
			$request = $this->Eliminar($sql);
			return $request;
		}

	}

 ?>
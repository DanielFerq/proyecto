<?php 
	class marca_Model extends mysql{

		public $stridMarca;
		public $strMarca; 
		public $intEstado;

		public function __construct(){

			parent::__construct();

		}

		public function ListarMarca(){
			$sql = "CALL SPU_MARCA_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function SeleccionarMarca(string $idmarca){
			$this->stridMarca = $idmarca;
			$sql = "CALL SPU_MARCA_SELECCIONAR('{$this->stridMarca}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function RegistrarMarca(string $marca,int $estado){
			$this->strMarca = $marca;
			$this->intEstado = $estado;
			$return = 0;

			$sql_consultar = "SELECT * FROM marcas WHERE nombremarca = '{$this->strMarca}'";
			$resultado = $this->Listar($sql_consultar);

			if(empty($resultado)){
				$sql  = "CALL SPU_MARCA_REGISTRAR(?,?)";
	        	$arrData = array($this->strMarca, $this->intEstado);
	        	$insertarDato = $this->Registrar($sql,$arrData);
	        	$return = $insertarDato;
			}else{
				$return = "existe";
			}

	        return $return;
		}

		public function ModificarMarca(string $idmarca, string $nombremarca, int $estado){

			$this->stridMarca = $idmarca;
			$this->strMarca = $nombremarca;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM marcas WHERE nombremarca = '{$this->strMarca}' AND idmarca != '{$this->stridMarca}'";
			
			$resultado = $this->Listar($sql);

			if(empty($resultado)){
	
				$sql = "CALL SPU_MARCA_MODIFICAR(?,?,?)";
				$arrData = array($this->stridMarca,$this->strMarca,$this->intEstado);
				$resultado = $this->Modificar($sql,$arrData);
			}else{
				$resultado = "existe";
			}
			return $resultado;

		}

		public function EliminarMarca(string $idmarca){
			$this->stridMarca = $idmarca;
			$sql = "CALL SPU_MARCA_ELIMINAR('{$this->stridMarca}')";
			$request = $this->Eliminar($sql);
			return $request;
		}

	}

 ?>
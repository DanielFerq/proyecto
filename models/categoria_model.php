<?php 
	class categoria_Model extends mysql{

		public $stridCategoria;
		public $stridClasificacion;
		public $strCategoria; 
		public $strDescripcion; 
		public $intEstado;

		public function __construct(){

			parent::__construct();

		}

		public function ListarCategoria(){

			$sql = "CALL SPU_CATEGORIA_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function SeleccionarCategoria(string $idcategoria){
			$this->stridCategoria = $idcategoria;
			$sql = "CALL SPU_CATEGORIA_SELECCIONAR('{$this->stridCategoria}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function RegistrarCategoria(string $idclasificacion, string $categoria, string $descripcion, int $estado){

			$this->stridClasificacion = $idclasificacion;
			$this->strCategoria = $categoria;
			$this->strDescripcion = $descripcion;
			$this->intEstado = $estado;
			$return = 0;

			$sql_consultar = "SELECT * FROM categorias WHERE categoria = '{$this->strCategoria}'";
			$resultado = $this->Listar($sql_consultar);

			if(empty($resultado)){
				$sql  = "CALL SPU_CATEGORIA_REGISTRAR(?,?,?,?)";
	        	$arrData = array($this->stridClasificacion,
        						$this->strCategoria,
        						$this->strDescripcion,
        						$this->intEstado);

	        	$insertarDato = $this->Registrar($sql,$arrData);
	        	$return = $insertarDato;
			}else{
				$return = "existe";
			}

	        return $return;
		}

		public function ModificarCategoria(string $idcategoria,string $idclasificacion, string $categoria, string $descripcion, int $estado){

			$this->stridCategoria = $idcategoria;
			$this->stridClasificacion = $idclasificacion;
			$this->strCategoria = $categoria;
			$this->strDescripcion = $descripcion;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM categorias WHERE categoria = '{$this->strCategoria}' AND idcategoria != '{$this->stridCategoria}'";
			
			$resultado = $this->Listar($sql);

			if(empty($resultado)){
	
				$sql = "CALL SPU_CATEGORIA_MODIFICAR(?,?,?,?,?)";
				$arrData = array($this->stridCategoria,
								$this->stridClasificacion,
        						$this->strCategoria,
        						$this->strDescripcion,
        						$this->intEstado);
				$resultado = $this->Modificar($sql,$arrData);
			}else{
				$resultado = "existe";
			}
			return $resultado;

		}

		public function EliminarCategoria($idcategoria){
			$this->stridCategoria = $idcategoria;
			$sql = "CALL SPU_CATEGORIA_ELIMINAR('{$this->stridCategoria}')";
			$request = $this->Eliminar($sql);
			return $request;
		}

	}

 ?>
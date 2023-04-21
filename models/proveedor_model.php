<?php 
	class proveedor_Model extends mysql{

		public $stridProveedor;
		public $strRazonSocial; 
		public $intRUC; 
		public $strNombreComercial; 
		public $strImagen;
		public $intMovil; 
		public $intFijo; 
		public $strDireccion;
		public $strCorreo;
		public $intEstado;

		public function __construct(){

			parent::__construct();

		}

		public function ListarProveedor(){
			$sql = "CALL SPU_EMPRESA_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function SeleccionarProveedor(string $idproveedor){
			$this->stridProveedor = $idproveedor;
			$sql = "CALL SPU_EMPRESA_SELECCIONAR('{$this->stridProveedor}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function RegistrarProveedor(string $razonsocial, int $ruc, string $nombrecomercial, 
											string $imagen, int $movil, int $fijo, string $direccion, string $correo, int $estado){

			$return = 0;
			$this->strRazonSocial = $razonsocial;
			$this->intRUC = $ruc;
			$this->strNombreComercial = $nombrecomercial;
			$this->strImagen = $imagen;
			$this->intMovil = $movil;
			$this->intFijo = $fijo;
			$this->strDireccion = $direccion;
			$this->strCorreo = $correo;
			$this->intEstado = $estado;

			$sql_consultar = "SELECT * FROM empresas WHERE razonsocial = '{$this->strRazonSocial}' or ruc = '{$this->intRUC}'";
			$resultado = $this->Listar($sql_consultar);

			if(empty($resultado)){
				$sql  = "CALL SPU_EMPRESA_REGISTRAR(?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strRazonSocial,
        						$this->intRUC,
        						$this->strNombreComercial,
        						$this->strImagen,
        						$this->intMovil,
        						$this->intFijo,
        						$this->strDireccion,
        						$this->strCorreo,
        						$this->intEstado);

	        	$insertarDato = $this->Registrar($sql,$arrData);
	        	$return = $insertarDato;
			}else{
				$return = "existe";
			}

	        return $return;
		}

		public function ModificarProveedor(string $idproveedor, string $razonsocial, int $ruc, string $nombrecomercial, 
											string $imagen, int $movil, int $fijo, string $direccion, string $correo, int $estado){

			$this->stridProveedor = $idproveedor;
			$this->strRazonSocial = $razonsocial;
			$this->intRUC = $ruc;
			$this->strNombreComercial = $nombrecomercial;
			$this->strImagen = $imagen;
			$this->intMovil = $movil;
			$this->intFijo = $fijo;
			$this->strDireccion = $direccion;
			$this->strCorreo = $correo;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM empresas WHERE (razonsocial = '{$this->strRazonSocial}' AND idempresa != '{$this->stridProveedor}')
					OR (ruc = '{$this->intRUC}' AND idempresa != '{$this->stridProveedor}')";
			
			$resultado = $this->Listar($sql);

			if(empty($resultado)){
				
				$sql = "CALL SPU_EMPRESA_MODIFICAR(?,?,?,?,?,?,?,?,?,?)";
				$arrData = array($this->stridProveedor,
								$this->strRazonSocial,
        						$this->intRUC,
        						$this->strNombreComercial,
        						$this->strImagen,
        						$this->intMovil,
        						$this->intFijo,
        						$this->strDireccion,
        						$this->strCorreo,
        						$this->intEstado);
				$resultado = $this->Modificar($sql,$arrData);
			}else{
				$resultado = "existe";
			}
			return $resultado;

		}

		public function EliminarProveedor(string $idproveedor){
			$this->stridProveedor = $idproveedor;
			$sql = "CALL SPU_EMPRESA_ELIMINAR('{$this->stridProveedor}')";
			$request = $this->Eliminar($sql);
			return $request;
		}

	}

 ?>
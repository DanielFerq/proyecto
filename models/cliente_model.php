<?php 
	class cliente_Model extends mysql{

		public $stridCliente;
		public $strNombres; 
		public $intDNI; 
		public $intRUC; 
		public $intCel;
		public $strCorreo;
		public $strDireccion;
		public $intEstado;

		public function __construct(){

			parent::__construct();

		}

		public function ListarCliente(){
			$sql = "CALL SPU_CLIENTE_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function SeleccionarCliente(string $idcliente){
			$this->stridCliente = $idcliente;
			$sql = "CALL SPU_CLIENTE_SELECCIONAR('{$this->stridCliente}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function RegistrarCliente(string $nombres, int $dni, int $ruc, int $celular, string $correo, string $direccion, int $estado){

			$this->strNombres = $nombres;
			$this->intDNI = $dni;
			$this->intRUC = $ruc;
			$this->intCel = $celular;
			$this->strCorreo = $correo;
			$this->strDireccion = $direccion;
			$this->intEstado = $estado;

			$return = 0;

			$sql_consultar = "SELECT * FROM clientes WHERE dni = '{$this->intDNI}' OR ruc = '{$this->intRUC}'";
			$resultado = $this->Listar($sql_consultar);

			if(empty($resultado)){
				$sql  = "CALL SPU_CLIENTE_REGISTRAR(?,?,?,?,?,?,?)";
	        	$arrData = array($this->strNombres,
        						$this->intDNI,
        						$this->intRUC,
        						$this->intCel,
        						$this->strCorreo,
        						$this->strDireccion,
        						$this->intEstado);

	        	$insertarDato = $this->Registrar($sql,$arrData);
	        	$return = $insertarDato;
			}else{
				$return = "existe";
			}

	        return $return;
		}

		public function ModificarCliente(string $idcliente, string $nombres, string $dni, string $ruc, int $celular, string $correo, string $direccion, int $estado){

			$this->stridCliente = $idcliente;
			$this->strNombres = $nombres;
			$this->intDNI = $dni;
			$this->intRUC = $ruc;
			$this->intCel = $celular;
			$this->strCorreo = $correo;
			$this->strDireccion = $direccion;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM clientes WHERE (dni = '{$this->intDNI}' AND idcliente != '{$this->stridCliente}')
					OR (ruc = '{$this->intRUC}' AND idcliente != '{$this->stridCliente}')";
			
			$resultado = $this->Listar($sql);

			if(empty($resultado)){
				
				$sql = "CALL SPU_CLIENTE_MODIFICAR(?,?,?,?,?,?,?,?)";
				$arrData = array($this->stridCliente,
								$this->strNombres,
								$this->intDNI,
	    						$this->intRUC,
	    						$this->intCel,
	    						$this->strCorreo,
	    						$this->strDireccion,
	    						$this->intEstado);

				$resultado = $this->Modificar($sql,$arrData);
			}else{
				$resultado = "existe";
			}
			return $resultado;

		}

		public function EliminarCliente(string $idcliente){
			$this->stridCliente = $idcliente;
			$sql = "CALL SPU_CLIENTE_ELIMINAR('{$this->stridCliente}')";
			$request = $this->Eliminar($sql);
			return $request;
		}
	}


 ?>
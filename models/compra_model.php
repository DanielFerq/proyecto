<?php 
	class compra_Model extends mysql{

		public $stridCompra;
		public $stridProducto;
		public $stridUsuario; 
		public $stridEmpresa; 
		public $stridTempCompra;
		public $strSerie;
		public $strCantidad;
		public $strPrecio; 
		public $StrTotal;
		public $strStock;
		public $strFechaCompra;
		public $intEstado;
		public $idconfig;

		public function __construct(){

			parent::__construct();

		}
		
		public function SeleccionarProducto(string $idproducto){
			$this->stridProducto = $idproducto;
			$sql = "CALL SPU_PRODUCTO_SELECCIONAR('{$this->stridProducto}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function ModificarStockProducto($idproducto,$stock){
			$this->stridProducto = $idproducto;
			$this->strStock = $stock;

			$sql = "CALL SPU_PRODUCTO_STOCK_MODIFICAR(?,?)";
			$arrData = array($this->stridProducto,$this->strStock);
			$request = $this->Modificar($sql, $arrData);
			return $request;
		}

		public function RegistrarCompra(string $idusuario, string $idempresa, string $serie, string $total){

			$this->stridUsuario = $idusuario;
			$this->stridEmpresa = $idempresa;
			$this->strSerie = $serie;
			$this->StrTotal = $total;

			$sql = "CALL SPU_COMPRA_REGISTRAR(?,?,?,?)";
			$arrData = array(
				$this->stridUsuario,
				$this->stridEmpresa,
				$this->strSerie,
				$this->StrTotal);
			$request = $this->Registrar($sql, $arrData);
			//$resultado = $request->fetch(PDO::FETCH_ASSOC);
			return $request;
		}

		public function RegistrarDetalleCompra($idcompra,$idproducto,$cantidad,$precio){

			$this->stridCompra = $idcompra;
			$this->stridProducto = $idproducto;
			$this->strCantidad = $cantidad;
			$this->strPrecio = $precio;

			$sql = "CALL SPU_DET_COMPRAS_REGISTRAR(?,?,?,?)";
			$arrData = array(
				$this->stridCompra,
				$this->stridProducto,
				$this->strCantidad,
				$this->strPrecio);
			$request = $this->Registrar($sql, $arrData);
			return $request;
		}

		public function SeleccionarTempCompra(string $idproducto, string $idusuario){
			$this->stridProducto = $idproducto;
			$this->stridUsuario = $idusuario;
			$sql = "CALL SPU_TEMP_COMPRAS_SELECCIONAR('{$this->stridProducto}','{$this->stridUsuario}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function SeleccionarProductoId(string $idusuario){
			$this->stridUsuario = $idusuario;
			$sql = "CALL SPU_TEMP_COMPRAS_IDUSUARIO_SELECCIONAR('{$this->stridUsuario}')";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function EliminarProductoId(string $idusuario){
			$this->stridUsuario = $idusuario;
			$sql = "CALL SPU_TEMP_COMPRAS_IDUSUARIO_ELIMINAR('{$this->stridUsuario}')";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function RegistrarTempCompra(string $idusuario, string $idproducto, string $cantidad, string $precio){

			$this->stridUsuario = $idusuario;
			$this->stridProducto = $idproducto;
			$this->strCantidad = $cantidad;
			$this->strPrecio = $precio;

			$sql = "CALL SPU_TEMP_COMPRAS_REGISTRAR(?,?,?,?)";
			$arrData = array($this->stridUsuario,
							$this->stridProducto,
							$this->strCantidad,
							$this->strPrecio);
			$request = $this->Registrar($sql, $arrData);
			return $request;
		}

		public function ModificarTempCompra(string $idusuario, string $idproducto, string $cantidad){

			$this->stridUsuario = $idusuario;
			$this->stridProducto = $idproducto;
			$this->strCantidad = $cantidad;

			$sql = "CALL SPU_TEMP_COMPRAS_MODIFICAR(?,?,?)";
			$arrData = array($this->stridUsuario,
							$this->stridProducto,
							$this->strCantidad);
			$request = $this->Modificar($sql, $arrData);
			return $request;
		}

		public function ModificarCantidad(string $idtempcompra, string $cantidad){
			$this->stridTempCompra = $idtempcompra;
			$this->strCantidad = $cantidad;
			$sql = "CALL SPU_TEMP_COMPRAS_MODIFICAR_CANTIDAD(?,?)";
			$arrData = array($this->stridTempCompra, $this->strCantidad);
			$request = $this->Modificar($sql, $arrData);
			return $request;
		}

		public function ModificarPrecio(string $idtempcompra, string $precio){
			$this->stridTempCompra = $idtempcompra;
			$this->strPrecio = $precio;
			$sql = "CALL SPU_TEMP_COMPRAS_MODIFICAR_PRECIO(?,?)";
			$arrData = array($this->stridTempCompra, $this->strPrecio);
			$request = $this->Modificar($sql, $arrData);
			return $request;
		}

		public function EliminarTempCompra(string $idtempcompra){
			$this->stridTempCompra = $idtempcompra;
			$sql = "CALL SPU_TEMP_COMPRAS_ELIMINAR('{$this->stridTempCompra}')";
			$request = $this->Eliminar($sql);
			return $request;
		}

		//FUNCTION PARA REPORTES
		public function getEmpresa(){
			$sql = "SPU_CONFIGURACION_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function getCompra($idcompra){
			$sql = "SPU_CONFIGURACION_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}
	}


 ?>
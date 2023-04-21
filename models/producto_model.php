<?php 

//VIDEO DE COMPRAS 9:31
	class producto_Model extends mysql{

		public $strIdproducto;
		public $strIdMarca;
		public $strIdCategoria; 
		public $strIdPresentacion; 
		public $strCodigoBarra; 
		public $strSku; 
		public $strNombreProducto; 
		public $strDescripcion; 
		public $strTipo; 
		public $strStock; 
		public $strStockMin; 
		public $strPrecioCompra; 
		public $strPrecioVenta; 
		public $strDescuento; 
		public $strModelo; 
		public $strPortada; 
		public $intEstado;

		public function __construct(){

			parent::__construct();

		}

		public function ListarCategoriaP(){

			$sql = "CALL SPU_CATEGORIA_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function ListarProductos(){
			$sql = "CALL SPU_PRODUCTO_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function SeleccionarProducto(string $idproducto){
			$this->strIdproducto = $idproducto;
			$sql = "CALL SPU_PRODUCTO_SELECCIONAR('{$this->strIdproducto}')";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function RegistrarProductos(string $idmarca, string $idcategoria, string $idpresentacion,
			string $codigo, string $sku, string $nombre, string $descripcion, int $tipo, string $stock,
			string $stockmin, string $pcompra, string $pventa, string $descuento, string $modelo,  
			string $portada, int $estado){

			$this->strIdMarca = $idmarca;
			$this->strIdCategoria = $idcategoria; 
			$this->strIdPresentacion = $idpresentacion; 
			$this->strCodigoBarra = $codigo; 
			$this->strSku = $sku; 
			$this->strNombreProducto = $nombre; 
			$this->strDescripcion = $descripcion; 
			$this->strTipo = $tipo; 
			$this->strStock = $stock; 
			$this->strStockMin = $stockmin; 
			$this->strPrecioCompra = $pcompra; 
			$this->strPrecioVenta = $pventa; 
			$this->strDescuento = $descuento; 
			$this->strModelo = $modelo; 
			$this->strPortada = $portada; 
			$this->intEstado = $estado;

			$return = 0;

			$sql_consultar = "SELECT * FROM productos WHERE codigobarra = '{$this->strCodigoBarra}'";
			$resultado = $this->Listar($sql_consultar);

			if(empty($resultado)){
				$sql  = "CALL SPU_PRODUCTO_REGISTRAR(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->strIdMarca,
								$this->strIdCategoria, 
								$this->strIdPresentacion, 
								$this->strCodigoBarra, 
								$this->strSku,
								$this->strNombreProducto, 
								$this->strDescripcion,
								$this->strTipo,
								$this->strStock,
								$this->strStockMin,
								$this->strPrecioCompra,
								$this->strPrecioVenta,
								$this->strDescuento,
								$this->strModelo,
								$this->strPortada,
								$this->intEstado);

	        	$insertarDato = $this->Registrar($sql,$arrData);
	        	$return = $insertarDato;
			}else{
				$return = "existe";
			}

	        return $return;
		}

		public function ModificarProductos(string $idproducto, string $idmarca, string $idcategoria, string $idpresentacion,
			string $codigo, string $sku, string $nombre, string $descripcion, int $tipo, string $stock,
			string $stockmin, string $pcompra, string $pventa, string $descuento, string $modelo,  
			string $portada, int $estado){
				$this->strIdproducto = $idproducto;
				$this->strIdMarca = $idmarca;
				$this->strIdCategoria = $idcategoria; 
				$this->strIdPresentacion = $idpresentacion; 
				$this->strCodigoBarra = $codigo; 
				$this->strSku = $sku; 
				$this->strNombreProducto = $nombre; 
				$this->strDescripcion = $descripcion; 
				$this->strTipo = $tipo; 
				$this->strStock = $stock; 
				$this->strStockMin = $stockmin; 
				$this->strPrecioCompra = $pcompra; 
				$this->strPrecioVenta = $pventa; 
				$this->strDescuento = $descuento; 
				$this->strModelo = $modelo; 
				$this->strPortada = $portada; 
				$this->intEstado = $estado;


			$sql = "SELECT * FROM productos WHERE codigobarra = '{$this->strCodigoBarra}' AND idproducto != '{$this->strIdproducto}'";
			
			$resultado = $this->Listar($sql);

			if(empty($resultado)){
				$sql = "CALL SPU_PRODUCTO_MODIFICAR(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$arrData = array($this->strIdproducto,
								$this->strIdMarca,
								$this->strIdCategoria, 
								$this->strIdPresentacion, 
								$this->strCodigoBarra, 
								$this->strSku,
								$this->strNombreProducto, 
								$this->strDescripcion,
								$this->strTipo,
								$this->strStock,
								$this->strStockMin,
								$this->strPrecioCompra,
								$this->strPrecioVenta,
								$this->strDescuento,
								$this->strModelo,
								$this->strPortada,
								$this->intEstado);
				$resultado = $this->Modificar($sql,$arrData);
			}else{
				$resultado = "existe";
			}
			return $resultado;

		}

		public function EliminarProducto(string $idproducto){
			$this->strIdproducto = $idproducto;
			$sql = "CALL SPU_PRODUCTO_ELIMINAR('{$this->strIdproducto}')";
			$request = $this->Eliminar($sql);
			return $request;
		}

	 	public function BuscarPorCodigo($strCodigoBarra){
			$sql = "SELECT *FROM productos where codigobarra = '$strCodigoBarra'";
			return $this->Seleccionar($sql);
		} 

		public function BuscarPorNombre($strNombreProducto){
			$sql = "SELECT id, nombreproducto FROM productos where nombreproducto LIKE '%".$strNombreProducto."%' LIMIT 10";
			return $this->Listar($sql);
		} 

	}

 ?>
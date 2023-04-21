<?php 

	class permiso_Model extends mysql{

		public $strIdPermiso;
		public $strIdRol;
		public $strIdModulo;
		public $r;
		public $w;
		public $u;
		public $d;

		public function __construct(){

			parent::__construct();

		}

		public function SeleccionarModulo(){

			$sql = "CALL SPU_MODULO_LISTAR()";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function SeleccionarPermisoRol(string $idrol){

			$this->strIdRol = $idrol;
			$sql = "SELECT * FROM permisos WHERE idrol = '{$this->strIdRol}' ";
			$resultado = $this->Listar($sql);
			return $resultado;
		}

		public function EliminarPermisos(string $idrol){
			$this->strIdRol = $idrol;
			$sql = "DELETE FROM permisos WHERE idrol = '{$this->strIdRol}' ";
			$resultado = $this->Eliminar($sql);
			return $resultado;
		}

		public function RegistrarPermisos(string $idrol, string $idmodulo, string $r, string $w, string $u, string $d){
			$this->strIdRol = $idrol;
			$this->strIdModulo = $idmodulo;
			$this->r = $r;
			$this->w = $w;
			$this->u = $u;
			$this->d = $d;
			$sql  = "CALL SPU_PERMISO_REGISTRAR(?,?,?,?,?,?)";
			$arrData = array($this->strIdRol, $this->strIdModulo, $this->r, $this->w, $this->u, $this->d);
			$resultado = $this->Registrar($sql,$arrData);		
			return $resultado;
		}

		public function permisosModulo(string $idrol){
			$this->strIdRol = $idrol;
			$sql = "CALL SPU_PERMISO_IDROL('{$this->strIdRol}')";
			$request = $this->Listar($sql);
			//dep($request);
			$arrPermisos = array();
			for ($i=0; $i < count($request); $i++){ 
				$arrPermisos[$request[$i]['idmodulo']] = $request[$i];
			}
			return $arrPermisos;
			//dep($arrPermisos);
		}

	}

?>
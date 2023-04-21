<?php 

	class recuperar_Model extends mysql{

		private $stridUsuario;
		private $strUsuario;
		private $strClave;
		private $strToken;

		public function __construct(){
			parent::__construct();
		}

		public function getUsuarioCorreo(string $strCorreo){
			$this->strUsuario = $strCorreo;
			$sql = "SELECT idusuario,nombres,apellidos,estado FROM usuarios WHERE correo = '{$this->strUsuario}' AND  estado = '1' ";
			$request = $this->Seleccionar($sql);
			return $request;
		}

		public function setTokenUsuario(string $idusuario, string $token){
			$this->stridUsuario = $idusuario;
			$this->strToken = $token;
			/*$sql = "UPDATE usuarios SET token = '{$this->strToken}' WHERE idusuario = '{$this->stridUsuario}'";*/
			$sql = "UPDATE usuarios SET token = ? WHERE idusuario = '{$this->stridUsuario}'";
			$arrData = array($this->strToken);
			$request = $this->Modificar($sql,$arrData);
			return $request;
		}

		public function getUsuario(string $strCorreo, string $token){
			$this->strUsuario = $strCorreo;
			$this->strToken = $token;
			$sql = "SELECT idusuario FROM usuarios WHERE 
					correo = '{$this->strUsuario}' AND 
					token = '{$this->strToken}' AND 					
					estado = 1 ";
			$request = $this->Seleccionar($sql);
			return $request;
		}

		public function insertarClave(string $idusuario, string $clave){
			$this->stridUsuario = $idusuario;
			$this->strClave = $clave;
			$sql = "UPDATE usuarios SET clave = ?, token = ? WHERE idusuario = '{$this->stridUsuario}'";
			$arrData = array($this->strClave,"");
			$request = $this->Modificar($sql,$arrData);
			return $request;
		}

	}

 ?>
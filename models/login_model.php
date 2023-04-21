<?php 

	class login_Model extends mysql{

		private $stridUsuario;
		private $strUsuario;
		private $strClave;
		private $strToken;

		public function __construct(){
			parent::__construct();
		}

		public function loginUsuario(string $usuario, string $clave){
			$this->strUsuario = $usuario;
			$this->strClave = $clave;
			$sql = "CALL SPU_USUARIO_LOGIN('{$this->strUsuario}','{$this->strClave}')";
			//echo $sql = "SELECT idusuario,estado FROM usuarios
					//WHERE nombreusuario = '{$this->strUsuario}' AND clave = '{$this->strClave}' AND estado = '1'";
			$resultado = $this->Seleccionar($sql);
			return $resultado;
		}

		public function sessionLogin(string $idUsuario){
			$this->stridUsuario = $idUsuario;
			$sql = "CALL SPU_USUARIO_LOGIN_PERFIL('{$this->stridUsuario}')";
			$request = $this->Seleccionar($sql);
			$_SESSION['userData'] = $request;
			return $request;
		}

	}

 ?>
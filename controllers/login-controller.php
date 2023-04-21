<?php 	
	class login extends controllers{

		public function __construct(){
			//SI YA LOGUEADO POR DEFECTO MUESTRE LA VENTANA DE DASHBOARD (INICIO)
			session_start();
			//session_regenerate_id(true);
			if(isset($_SESSION['login'])){
				header('Location: '.base_url().'/dashboard');
			}
			//FIN
			parent::__construct();
		}

		public function login(){
			$data['page_tag'] = "Login";
			$data['page_title'] = "Login";
			$data['page_name'] = "login";
			$data['page_functions_js'] = "function-login.js";
			$this->views->getview($this,"login-view", $data);
		}

		public function loginUser(){
			//dep($_POST);
			if($_POST){
				if(empty($_POST['txtUsuario']) || empty($_POST['txtClave'])){
					$arrResponse = array('resultado' => false, 'msg' => 'Error de datos' );
				}else{
					$strUsuario  =  strClean($_POST['txtUsuario']);
					$strClave = hash("SHA256",$_POST['txtClave']);
					$requestUser = $this->model->loginUsuario($strUsuario, $strClave);
					if(empty($requestUser)){
						$arrResponse = array('resultado' => false, 'msg' => 'El usuario o la contraseña es incorrecto.' ); 
					}else{
						$arrData = $requestUser;
						if($arrData['estado'] == 1){
							$_SESSION['idusuario'] = $arrData['idusuario'];
							$_SESSION['login'] = true;

							$arrData = $this->model->sessionLogin($_SESSION['idusuario']);
							//$_SESSION['userData'] = $arrData;
							sessionUsuario($_SESSION['idusuario']);							
							$arrResponse = array('resultado' => true, 'msg' => 'ok');
						}else{
							$arrResponse = array('resultado' => false, 'msg' => 'Usuario inactivo.');
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>
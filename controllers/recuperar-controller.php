<?php 	

	class recuperar extends controllers{

		public function __construct(){

		/*	session_start();
			if(isset($_SESSION['login'])){
				header('Location: '.base_url().'/dashboard');
			}*/
			parent::__construct();

		}

	    public function recuperar(){

	      $data['page_id'] = 20;
	      $data['page_tag'] = "Recuperar - AdmSytem";
	      $data['page_title'] = "Recuperar - Tienda";
	      $data['page_name'] = "Recuperar cuenta";
	      $data['page_functions_js'] = "function-recuperar.js";
	      $this->views->getview($this,"recuperar-view", $data);
	    }


		public function resetClave(){
			if($_POST){
				error_reporting(0); // Desactivamos esto cuando subimos a un hosting

				if(empty($_POST['txtResetCorreo'])){
					$arrResponse = array('resultado' => false, 'msg' => 'Error de datos' );
				}else{
					$token = token();
					$strCorreo  =  strtolower(strClean($_POST['txtResetCorreo']));
					$arrData = $this->model->getUsuarioCorreo($strCorreo);

					if(empty($arrData)){
						$arrResponse = array('resultado' => false, 'msg' => 'Usuario no existente.' ); 
					}else{
						$idusuario = $arrData['idusuario'];
						$nombreUsuario = $arrData['nombres'].' '.$arrData['apellidos'];

						$url_recovery = base_url().'/recuperar/confirmarUsuario/'.$strCorreo.'/'.$token;
						$requestUpdate = $this->model->setTokenUsuario($idusuario,$token);

						$dataUsuario = array('nombre_usuario' => $nombreUsuario,
											 'correo' => $strCorreo,
											 'asunto' => 'Recuperar cuenta - '.NOMBRE_REMITENTE,
											 'url_recovery' => $url_recovery); 
						if($requestUpdate){
							$sendCorreo = sendCorreo($dataUsuario,'correo_cambiar_clave');

							if($sendCorreo){
								$arrResponse = array('resultado' => true, 'msg' => 'Se ha enviado un email a tu cuenta de correo para cambiar tu contraseña.');
							}else{
								$arrResponse = array('resultado' => false, 
												 'msg' => 'No es posible realizar el proceso, intenta más tarde.' );
							}
						}else{
							$arrResponse = array('resultado' => false, 'msg' => 'No es posible realizar el proceso, intenta más tarde.' );
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function confirmarUsuario(string $params){

			if(empty($params)){
				header('Location: '.base_url());
			}else{
				$arrParams = explode(',',$params);
				$strCorreo = strClean($arrParams[0]);
				$strToken = strClean($arrParams[1]);

				$arrResponse = $this->model->getUsuario($strCorreo,$strToken);
				if(empty($arrResponse)){
					header("Location: ".base_url());
				}else{
					$data['page_tag'] = "Cambiar clave";
					$data['page_name'] = "Cambiar_clave";
					$data['page_title'] = "Usuarios - <small> Tienda </small>";
					$data['correo'] = $strCorreo;
					$data['token'] = $strToken;
					$data['idusuario'] = $arrResponse['idusuario'];
					$data['page_functions_js'] = "function-recuperar.js";
					$this->views->getview($this,"cambiar_clave-view", $data);
				}
			}
			die();
		}

		public function setClave(){

		if(empty($_POST['idusuario']) || empty($_POST['txtCorreo']) || empty($_POST['txtToken']) || empty($_POST['txtclaveNuevo']) || empty($_POST['txtclaveNuevo2'])){

					$arrResponse = array('resultado' => false, 'msg' => 'Error de datos');
				}else{
					$stridUsuario = strClean($_POST['idusuario']);
					$strPassword = $_POST['txtclaveNuevo'];
					$strPasswordConfirm = $_POST['txtclaveNuevo2'];
					$strCorreo = strClean($_POST['txtCorreo']);
					$strToken = strClean($_POST['txtToken']);

					if($strPassword != $strPasswordConfirm){
						$arrResponse = array('resultado' => false, 'msg' => 'Las contraseñas no son iguales.' );
					}else{
						$arrResponseUser = $this->model->getUsuario($strCorreo,$strToken);
						if(empty($arrResponseUser)){
							$arrResponse = array('resultado' => false,'msg' => 'Error de datos.');
						}else{
							$strPassword = hash("SHA256",$strPassword);
							$requestPass = $this->model->insertarClave($stridUsuario,$strPassword);

							if($requestPass){
								$arrResponse = array('resultado' => true,'msg' => 'Contraseña actualizada con éxito.');
							}else{
								$arrResponse = array('resultado' => false, 'msg' => 'No es posible realizar el proceso, intente más tarde.');
							}
						}
					}
				}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();

		}

	}

 ?>
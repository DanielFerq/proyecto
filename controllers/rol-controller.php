<?php 	

	class rol extends controllers{

		public function __construct(){

			parent::__construct();
			session_start();
			//session_regenerate_id(true);
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
			

		}

		public function rol(){
			if(empty($_SESSION['permisosMod']['r'])){
				header('Location: '.base_url().'/dashboard');
			}

			$data['page_id'] = 6;
			$data['page_tag'] = "Roles Usuario";
			$data['page_name'] = "rol_usuario";
			$data['page_title'] = "Roles Usuario - <small> Tienda </small>";
			$data['page_functions_js'] = "function-rol.js";
			$this->views->getview($this,"rol-view", $data);
		}

		public function getRoles(){
			if($_SESSION['permisosMod']['r']){
				$btnVer = '';
				$btnEdit = '';
				$btnElim = '';

				$miTabla = $this->model->ListarRoles();

				for($i=0; $i < count($miTabla); $i++) {


					if($miTabla[$i]['estado']== 1){
						$miTabla[$i]['estado'] = '<div class="text-center"><span class="badge badge-success">Activado</span></div>';
					}
					else{
						$miTabla[$i]['estado'] = '<div class="text-center"><span class="badge badge-danger">Desactivado</span></div>';
					}

					if($_SESSION['permisosMod']['u']){
						$btnVer = '	<button type="button" data-operacion="permiso" class="btn btn-secondary btn-sm" data-id="'.$miTabla[$i]['idrol'].'" title="Permisos">
										<i class="icon-copy fa fa-key" aria-hidden="true"></i>
									</button> ';

						$btnEdit = '<button type="button" data-operacion="editar" class="btn btn-info btn-sm" data-id="'.$miTabla[$i]['idrol'].'" title="Editar">
										<i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
									</button>';
					}

					if($_SESSION['permisosMod']['d']){
						$btnElim = '<button type="button" data-operacion="eliminar" class="btn btn-danger btn-sm" data-id="'.$miTabla[$i]['idrol'].'" title="Eliminar">
										<i class="icon-copy fa fa-trash" aria-hidden="true"></i>
									</button>';
					}

					$miTabla[$i]['opcion'] = '<div class="table-actions btn-list">'.$btnVer.' '.$btnEdit.' '.$btnElim.'</div>';	
				}


				echo json_encode($miTabla,JSON_UNESCAPED_UNICODE);
			}
			die();
				//dep($miTabla);
		}

		public function getRol($idRol){
			if($_SESSION['permisosMod']['r']){

				$strIdRol = strClean($idRol);
				$arrData =  $this->model->SeleccionarRol($strIdRol);
				if(empty($arrData)){
					$arrResponse =  array('resultado' => false, 'msg' => 'Datos no econtrado.');	
				}else{
					$arrResponse =  array('resultado' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setRol(){
				//dep($_POST);
			if($_SESSION['permisosMod']['w']){
				//RECIBIMOS LOS DATOS MEDIANTE METODO _POST
				$strIdRol = strClean($_POST['txtidrol']);
				$strRol = strClean($_POST['txtnom']);
				$strDescripcion = strClean($_POST['txtdesc']);
				$intEstado	= intval($_POST['cboestado']);

					//ENVIAR LA INFORMACIÓN AL MODELO	
				if($strIdRol == ""){
					$request_rol = $this->model->RegistrarRoles($strRol,$strDescripcion,$intEstado);

						//OPCION = 1 REGISTRAR
					$opcion = 1;
				}else{
						//$strIdRol = strClean($_POST['idrol']);
					$request_rol = $this->model->ModificarRoles($strIdRol,$strRol,$strDescripcion,$intEstado);

						//OPCION = 2 MODIFICAR
					$opcion = 2;
				}


				if($request_rol > 0){

					if($opcion == 1){
						$arrResponse = array('resultado' => true, 'msg' => 'Datos guardado correctamente.');			
					}else{
						$arrResponse = array('resultado' => true, 'msg' => 'Datos Actualizados correctamente.');	
					}
					
				}else if($request_rol == 'existe'){
					$arrResponse = array('resultado' => false, 'msg' => '¡Atención! El nombre del Rol ya existe.');
				}else{
					$arrResponse = array('resultado' => false, 'msg' => 'No es posible almacenar los datos.');
				}

				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delRol(){
			if($_POST){
				if($_SESSION['permisosMod']['d']){
				
					$strIdRol = strClean($_POST['idrol']);
					$requestDelete = $this->model->EliminarRoles($strIdRol);
					
					if($requestDelete == 'ok'){

						$arrResponse = array('resultado' => true, 'msg' => 'Se ha eliminado el Rol correctamente.');

					}else if($requestDelete == 'existe'){

						$arrResponse = array('resultado' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');

					}else{

						$arrResponse = array('resultado' => false, 'msg' => 'Error al eliminar el Rol.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function getSeleccionarRoles(){
			$htmlOptions = "";
			$arrData = $this->model->ListarRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
						$htmlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}


	}
?>
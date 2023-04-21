<?php 	

	class presentacion extends controllers{

		public function __construct(){

			parent::__construct();
			session_start();
			//session_regenerate_id(true);
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
			
			getPermisos("MD00000010");

		}

		public function presentacion(){
			if(empty($_SESSION['permisosMod']['r'])){
				header('Location: '.base_url().'/dashboard');
			}

			$data['page_id'] = 10;
			$data['page_tag'] = "Presentación";
			$data['page_name'] = "presentacion";
			$data['page_title'] = "Presentación - <small> Tienda </small>";
			$data['page_functions_js'] = "function-presentacion.js";
			$this->views->getview($this,"presentacion-view", $data);
		}

		 public function setPresentacion(){
        if ($_POST) {

            if (empty($_POST['txtnom'])){

                $arrResponse = array("resultado" => false, "msg" => 'Datos incorrectos.');

            } else {
                $idPresentacion = strClean($_POST['txtidpresentacion']);
                $strPresentacion = strClean($_POST['txtnom']);;
                $strDesc = strClean($_POST['txtdesc']);;
                $intEstado = intval($_POST['cboestado']);

                $request_Presentacion = "";

                if ($idPresentacion == "") {
                    $option = 1;

                    if ($_SESSION['permisosMod']['w']) {
                        $request_Presentacion = $this->model->RegistrarPresentacion($strPresentacion,$strDesc,$intEstado);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['u']) {
                        $request_Presentacion = $this->model->ModificarPresentacion($idPresentacion,$strPresentacion,$strDesc,$intEstado);
                    }

                }

                if ($request_Presentacion > 0) {
                    if ($option == 1) {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_Presentacion == 'existe') {
                    $arrResponse = array('resultado' => false, 'msg' => '¡Atención! el nombre de la presentación  ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("resultado" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getPresentacion(){
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->ListarPresentaciones();
            for ($i = 0; $i < count($miTabla); $i++) {
                $btnVer = '';
                $btnEdit = '';
                $btnElim = '';

                if ($miTabla[$i]['estado'] == 1) {
                    $miTabla[$i]['estado'] = '<div class="text-center"><span class="badge badge-success">Activado</span></div>';
                } else {
                    $miTabla[$i]['estado'] = '<div class="text-center"><span class="badge badge-danger">Desactivado</span></div>';
                }

                if ($_SESSION['permisosMod']['u']) {
                        $btnEdit = '<button type="button" class="btn btn-info btn-sm" data-operacion="editar" data-id="'.$miTabla[$i]['idpresentacion'].'" title="Editar">
                                        <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                                    </button>';
                    }

                if ($_SESSION['permisosMod']['d']){
                        $btnElim = '<button type="button" class="btn btn-danger btn-sm" data-operacion="eliminar" data-id="' . $miTabla[$i]['idpresentacion'] . '" title="Eliminar">
                                        <i class="icon-copy fa fa-trash" aria-hidden="true"></i>
                                    </button>';
                    } 

                $miTabla[$i]['opcion'] = '<div class="text-center">'.$btnEdit.' '.$btnElim.'</div>';

            }

            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getidPresentacion($idpresentacion){
        if ($_SESSION['permisosMod']['r']) {

            $strIdPresentacion = strClean($idpresentacion);

            $arrData = $this->model->seleccionarPresentacion($strIdPresentacion);
            if (empty($arrData)) {
                $arrResponse = array('resultado' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('resultado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delPresentacion(){
        if ($_POST){
            if ($_SESSION['permisosMod']['d']) {
                $strIdPresentacion = strClean($_POST['idpresentacion']);
                $requestDelete = $this->model->EliminarPresentacion($strIdPresentacion);

                if ($requestDelete) {
                    $arrResponse = array('resultado' => true, 'msg' => 'Se ha eliminado la presentación.');
                } else {
                    $arrResponse = array('resultado' => false, 'msg' => 'Error con eliminar la presentación.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

		public function getSeleccionarPresentacion(){
			$htmlOptions = "";
			$arrData = $this->model->ListarPresentaciones();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
						$htmlOptions .= '<option value="'.$arrData[$i]['idpresentacion'].'">'.$arrData[$i]['presentacion'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

	}

 ?>
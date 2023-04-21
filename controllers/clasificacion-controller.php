<?php 	

	class clasificacion extends controllers{

		public function __construct(){

			parent::__construct();
			session_start();
			//session_regenerate_id(true);
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
			
			getPermisos("MD00000002");

		}

		public function clasificacion(){
			if(empty($_SESSION['permisosMod']['r'])){
				header('Location: '.base_url().'/dashboard');
			}

			$data['page_id'] = 2;
			$data['page_tag'] = "Clasificación";
			$data['page_name'] = "clasificacion";
			$data['page_title'] = "Clasificación - <small> Tienda </small>";
			$data['page_functions_js'] = "function-clasificacion.js";
			$this->views->getview($this,"clasificacion-view", $data);
		}

		 public function setClasificacion(){
        if ($_POST) {

            if (empty($_POST['txtnom'])){

                $arrResponse = array("resultado" => false, "msg" => 'Datos incorrectos.');

            } else {
                $idClasificacion = strClean($_POST['txtidclasificacion']);
                $strClasificacion = strClean($_POST['txtnom']);;
                $intEstado = intval($_POST['cboestado']);

                $request_clasificacion = "";

                if ($idClasificacion == "") {
                    $option = 1;

                    if ($_SESSION['permisosMod']['w']) {
                        $request_clasificacion = $this->model->RegistrarClasificacion($strClasificacion,$intEstado,);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['u']) {
                        $request_clasificacion = $this->model->ModificarClasificacion($idClasificacion, $strClasificacion, $intEstado,);
                    }

                }

                if ($request_clasificacion > 0) {
                    if ($option == 1) {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_clasificacion == 'existe') {
                    $arrResponse = array('resultado' => false, 'msg' => '¡Atención! la clasificación ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("resultado" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getClasificacion(){
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->ListarClasificacion();
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
                        $btnEdit = '<button type="button" class="btn btn-info btn-sm" data-operacion="editar" data-id="'.$miTabla[$i]['idclasificacion'].'" title="Editar">
                                        <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                                    </button>';
                    }

                if ($_SESSION['permisosMod']['d']){
                        $btnElim = '<button type="button" class="btn btn-danger btn-sm" data-operacion="eliminar" data-id="' . $miTabla[$i]['idclasificacion'] . '" title="Eliminar">
                                        <i class="icon-copy fa fa-trash" aria-hidden="true"></i>
                                    </button>';
                    } 

                $miTabla[$i]['opcion'] = '<div class="text-center">'.$btnEdit.' '.$btnElim.'</div>';

            }

            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getidClasificacion($idclasificacion)
    {
        if ($_SESSION['permisosMod']['r']) {

            $strIdClasificacion = strClean($idclasificacion);

            $arrData = $this->model->seleccionarClasificacion($strIdClasificacion);
            if (empty($arrData)) {
                $arrResponse = array('resultado' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('resultado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delClasificacion(){
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $strIdClasificacion = strClean($_POST['idclasificacion']);
                $requestDelete = $this->model->EliminarClasificacion($strIdClasificacion);

                if ($requestDelete) {
                    $arrResponse = array('resultado' => true, 'msg' => 'Se ha eliminado la clasificación.');
                } else {
                    $arrResponse = array('resultado' => false, 'msg' => 'Error al eliminar la clasificación.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

		public function getSeleccionarClasificacion(){
			$htmlOptions = "";
			$arrData = $this->model->ListarClasificacion();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
						$htmlOptions .= '<option value="'.$arrData[$i]['idclasificacion'].'">'.$arrData[$i]['clasificacion'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

	}

 ?>
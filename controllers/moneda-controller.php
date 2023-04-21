<?php 	

	class moneda extends controllers{

		public function __construct(){

			parent::__construct();
			session_start();
			//session_regenerate_id(true);
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
			
			getPermisos("MD00000004");

		}

		public function moneda(){
			if(empty($_SESSION['permisosMod']['r'])){
				header('Location: '.base_url().'/dashboard');
			}

			$data['page_id'] = 4;
			$data['page_tag'] = "Monedas";
			$data['page_name'] = "moneda";
			$data['page_title'] = "Monedas - <small> Tienda </small>";
			$data['page_functions_js'] = "function-moneda.js";
			$this->views->getview($this,"moneda-view", $data);
		}

	public function setMoneda(){
        if ($_POST) {
            if (empty($_POST['txtnom'])){
                $arrResponse = array("resultado" => false, "msg" => 'Datos incorrectos.');

            } else {
                $idmoneda = strClean($_POST['txtidmoneda']);
                $strmoneda = strClean($_POST['txtnom']);;
                $intEstado = intval($_POST['cboestado']);

                $request_moneda = "";

                if ($idmoneda == "") {
                    $option = 1;
                    if ($_SESSION['permisosMod']['w']) {
                        $request_moneda = $this->model->Registrarmoneda($strmoneda,$intEstado);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['u']) {
                        $request_moneda = $this->model->Modificarmoneda($idmoneda, $strmoneda, $intEstado);
                    }

                }

                if ($request_moneda > 0) {
                    if ($option == 1) {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_moneda == 'existe') {
                    $arrResponse = array('resultado' => false, 'msg' => '¡Atención! el nombre de moneda ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("resultado" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getmoneda(){
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->Listarmoneda();
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
                        $btnEdit = '<button type="button" class="btn btn-info btn-sm" data-operacion="editar" data-id="'.$miTabla[$i]['idmoneda'].'" title="Editar">
                                        <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                                    </button>';
                    }

                if ($_SESSION['permisosMod']['d']){
                        $btnElim = '<button type="button" class="btn btn-danger btn-sm" data-operacion="eliminar" data-id="' . $miTabla[$i]['idmoneda'] . '" title="Eliminar">
                                        <i class="icon-copy fa fa-trash" aria-hidden="true"></i>
                                    </button>';
                    } 

                $miTabla[$i]['opcion'] = '<div class="text-center">'.$btnEdit.' '.$btnElim.'</div>';

            }

            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getidmoneda($idmoneda)
    {
        if ($_SESSION['permisosMod']['r']) {

            $strIdmoneda = strClean($idmoneda);

            $arrData = $this->model->seleccionarmoneda($strIdmoneda);
            if (empty($arrData)) {
                $arrResponse = array('resultado' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('resultado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delmoneda(){
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $strIdmoneda = strClean($_POST['idmoneda']);
                $requestDelete = $this->model->Eliminarmoneda($strIdmoneda);

                if ($requestDelete) {
                    $arrResponse = array('resultado' => true, 'msg' => 'Se ha eliminado la moneda');
                } else {
                    $arrResponse = array('resultado' => false, 'msg' => 'Error al eliminar la moneda.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

		public function getSeleccionarmoneda(){
			$htmlOptions = "";
			$arrData = $this->model->Listarmoneda();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
						$htmlOptions .= '<option value="'.$arrData[$i]['idmoneda'].'">'.$arrData[$i]['nombremoneda'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

	}

 ?>
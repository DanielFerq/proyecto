<?php 	

	class marca extends controllers{

		public function __construct(){

			parent::__construct();
			session_start();
			//session_regenerate_id(true);
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
			}
			
			getPermisos("MD00000004");

		}

		public function marca(){
			if(empty($_SESSION['permisosMod']['r'])){
				header('Location: '.base_url().'/dashboard');
			}

			$data['page_id'] = 4;
			$data['page_tag'] = "Marcas";
			$data['page_name'] = "marca";
			$data['page_title'] = "Marcas - <small> Tienda </small>";
			$data['page_functions_js'] = "function-marca.js";
			$this->views->getview($this,"marca-view", $data);
		}

	public function setMarca(){
        if ($_POST) {
            if (empty($_POST['txtnom'])){
                $arrResponse = array("resultado" => false, "msg" => 'Datos incorrectos.');

            } else {
                $idMarca = strClean($_POST['txtidmarca']);
                $strMarca = strClean($_POST['txtnom']);;
                $intEstado = intval($_POST['cboestado']);

                $request_marca = "";

                if ($idMarca == "") {
                    $option = 1;
                    if ($_SESSION['permisosMod']['w']) {
                        $request_marca = $this->model->RegistrarMarca($strMarca,$intEstado);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['u']) {
                        $request_marca = $this->model->ModificarMarca($idMarca, $strMarca, $intEstado);
                    }

                }

                if ($request_marca > 0) {
                    if ($option == 1) {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_marca == 'existe') {
                    $arrResponse = array('resultado' => false, 'msg' => '¡Atención! el nombre de marca ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("resultado" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getMarca(){
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->ListarMarca();
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
                        $btnEdit = '<button type="button" class="btn btn-info btn-sm" data-operacion="editar" data-id="'.$miTabla[$i]['idmarca'].'" title="Editar">
                                        <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                                    </button>';
                    }

                if ($_SESSION['permisosMod']['d']){
                        $btnElim = '<button type="button" class="btn btn-danger btn-sm" data-operacion="eliminar" data-id="' . $miTabla[$i]['idmarca'] . '" title="Eliminar">
                                        <i class="icon-copy fa fa-trash" aria-hidden="true"></i>
                                    </button>';
                    } 

                $miTabla[$i]['opcion'] = '<div class="text-center">'.$btnEdit.' '.$btnElim.'</div>';

            }

            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getidMarca($idmarca)
    {
        if ($_SESSION['permisosMod']['r']) {

            $strIdMarca = strClean($idmarca);

            $arrData = $this->model->seleccionarMarca($strIdMarca);
            if (empty($arrData)) {
                $arrResponse = array('resultado' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('resultado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delMarca(){
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $strIdMarca = strClean($_POST['idmarca']);
                $requestDelete = $this->model->EliminarMarca($strIdMarca);

                if ($requestDelete) {
                    $arrResponse = array('resultado' => true, 'msg' => 'Se ha eliminado la marca');
                } else {
                    $arrResponse = array('resultado' => false, 'msg' => 'Error al eliminar la marca.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

		public function getSeleccionarMarca(){
			$htmlOptions = "";
			$arrData = $this->model->ListarMarca();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
						$htmlOptions .= '<option value="'.$arrData[$i]['idmarca'].'">'.$arrData[$i]['nombremarca'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();		
		}

	}

 ?>
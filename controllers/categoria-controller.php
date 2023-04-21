<?php

//ARREGLAR EDITAR VIDE 11
class categoria extends controllers{

    public function __construct(){

        parent::__construct();
        session_start();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }

        getPermisos("MD00000003");

    }

    public function categoria(){
        if (empty($_SESSION['permisosMod']['r'])) {
            header('Location: ' . base_url() . '/dashboard');
        }

        $data['page_id'] = 3;
        $data['page_tag'] = "Categoría";
        $data['page_name'] = "categoria";
        $data['page_title'] = "Categoría - <small> Tienda </small>";
        $data['page_functions_js'] = "function-categoria.js";
        $this->views->getview($this, "categoria-view", $data);
    }

    public function setCategoria(){
        if ($_POST) {
            if (empty($_POST['txtnom']) || empty($_POST['txtdesc']) || empty($_POST['cboclas'])) {

                $arrResponse = array("resultado" => false, "msg" => 'Datos incorrectos.');

            } else {
                $idCategoria = strClean($_POST['txtidcategoria']);
                $strClasificacion = strClean($_POST['cboclas']);
                $strNombre = ucwords(strClean($_POST['txtnom']));
                $strDescripcion = ucwords(strClean($_POST['txtdesc']));
                $intEstado = intval($_POST['cboestado']);

                $request_categoria = "";

                if ($idCategoria == "") {
                    $option = 1;

                    if ($_SESSION['permisosMod']['w']) {
                        $request_categoria = $this->model->RegistrarCategoria(
                            $strClasificacion,
                            $strNombre,
                            $strDescripcion,
                            $intEstado);
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['u']) {
                        $request_categoria = $this->model->ModificarCategoria(
                            $idCategoria,
                            $strClasificacion,
                            $strNombre,
                            $strDescripcion,
                            $intEstado);
                    }

                }

                if ($request_categoria > 0) {
                    if ($option == 1) {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_categoria == 'existe') {
                    $arrResponse = array('resultado' => false, 'msg' => '¡Atención! la categoría ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("resultado" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getCategoria(){
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->ListarCategoria();
            for ($i = 0; $i < count($miTabla); $i++) {
                $btnEdit = '';
                $btnElim = '';

                if ($miTabla[$i]['estado'] == 1) {
                    $miTabla[$i]['estado'] = '<div class="text-center"><span class="badge badge-success">Activado</span></div>';
                } else {
                    $miTabla[$i]['estado'] = '<div class="text-center"><span class="badge badge-danger">Desactivado</span></div>';
                }

                if ($_SESSION['permisosMod']['u']) {
                    $btnEdit = '<button type="button" class="btn btn-info btn-sm" data-operacion="editar" data-id="' . $miTabla[$i]['idcategoria'] . '" title="Editar">
                                    <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                                </button>';
                }

                if ($_SESSION['permisosMod']['d']) {
                    $btnElim = '<button type="button" class="btn btn-danger btn-sm" data-operacion="eliminar" data-id="' . $miTabla[$i]['idcategoria'] . '" title="Eliminar">
                                    <i class="icon-copy fa fa-trash" aria-hidden="true"></i>
                                </button>';
                }

                $miTabla[$i]['opcion'] = '<div class="text-center">'.$btnEdit.' '.$btnElim.'</div>';

            }

            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

        public function getidCategoria($idcategoria){
            if ($_SESSION['permisosMod']['r']) {
                $strIdCategoria = strClean($idcategoria);
                $arrData = $this->model->SeleccionarCategoria($strIdCategoria);
                if (empty($arrData)) {
                    $arrResponse = array('resultado' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('resultado' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function delCategoria(){
            if ($_POST){
                if ($_SESSION['permisosMod']['d']) {
                    $strIdCategoria = strClean($_POST['idcategoria']);
                    $requestDelete = $this->model->EliminarCategoria($strIdCategoria);
                    if ($requestDelete) {
                        $arrResponse = array('resultado' => true, 'msg' => 'Se ha eliminado la categoría.');
                    } else {
                        $arrResponse = array('resultado' => false, 'msg' => 'Error al eliminar la categoría.');
                    }
                    echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }

        public function getSeleccionarCategoria(){
            $htmlOptions = "";
            $arrData = $this->model->ListarCategoria();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                    if($arrData[$i]['estado'] == 1 ){
                        $htmlOptions .= '<option value="'.$arrData[$i]['idcategoria'].'">'.$arrData[$i]['categoria'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();       
        }

}

?>
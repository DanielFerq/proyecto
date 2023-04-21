<?php

class proveedor extends controllers{

    public function __construct()
    {

        parent::__construct();
        session_start();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('Location: ' .base_url(). '/login');
            die();
        }
        getPermisos('MD00000013');
    }

    public function proveedor()
    {

        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" .base_url().'/dashboard');
        }

        $data['page_id'] = 5;
        $data['page_tag'] = "Proveedor";
        $data['page_name'] = "proveedor";
        $data['page_title'] = "Proveedores - <small> Tienda </small>";
        $data['page_functions_js'] = "function-proveedor.js";
        $this->views->getview($this, "proveedor-view", $data);
    }

    public function setProveedor(){
        if ($_POST){
            if (empty($_POST['txtrazons']) || empty($_POST['txtnomcom']) || 
                empty($_POST['txtruc'])){

                $arrResponse = array("resultado" => false, "msg" => 'Datos incorrectos.');

            } else {
                $idProveedor = strClean($_POST['txtidproveedor']);
                $strRazons = strtoupper(strClean($_POST['txtrazons']));
                $strNombreC = strtoupper(strClean($_POST['txtnomcom']));
                $intRuc = intval(strClean($_POST['txtruc']));
                $intMovil = intval(strClean($_POST['txtmovil']));
                $intFijo = intval(strClean($_POST['txtfijo']));
                $strDirec = strClean($_POST['txtdirec']);
                $strCorreo = strtolower(strClean($_POST['txtcorreo']));
                $intEstado = intval($_POST['cboestado']);

                //OBTENEMOS TODA LA INFO DE LA FOTO
                $foto           = $_FILES['txtfoto'];
                $nombre_foto    = $foto['name'];
                $type           = $foto['type'];
                $url_temp       = $foto['tmp_name'];
                $img            = 'imagen-default.png';
                $request_proveedor = "";
                if($nombre_foto != ''){
                    $img = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
                }


                if ($idProveedor == "") {
                    $option = 1;
                    if ($_SESSION['permisosMod']['w']) {
                        $request_proveedor = $this->model->RegistrarProveedor(
                            $strRazons,
                            $intRuc,
                            $strNombreC,
                            $img,
                            $intMovil,
                            $intFijo,
                            $strDirec,
                            $strCorreo,
                            $intEstado);
                    }
                } else {
                    $option = 2;
                    if($nombre_foto == ''){
                        if($_POST['foto_actual'] != 'imagen-default.png' && $_POST['foto_remove'] == 0 ){
                            $img = $_POST['foto_actual'];
                        }
                    }
                    if ($_SESSION['permisosMod']['u']) {
                        $request_proveedor = $this->model->ModificarProveedor(
                            $idProveedor,
                            $strRazons,
                            $intRuc,
                            $strNombreC,
                            $img,
                            $intMovil,
                            $intFijo,
                            $strDirec,
                            $strCorreo,
                            $intEstado);
                    }

                }

                if ($request_proveedor > 0) {
                    if ($option == 1) {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != ''){ uploadImageProveedor($foto,$img); }
                    } else {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos Actualizados correctamente.');
                        if($nombre_foto != ''){ uploadImageProveedor($foto,$img); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'imagen-default.png')
                                || ($nombre_foto != '' && $_POST['foto_actual'] != 'imagen-default.png')){
                                deleteFileProveedor($_POST['foto_actual']);
                        }
                    }
                } else if ($request_proveedor == 'existe') {
                    $arrResponse = array('resultado' => false, 'msg' => '¡Atención! el correo o el número de RUC ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("resultado" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getProveedor()
    {
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->ListarProveedor();
            for ($i = 0; $i < count($miTabla); $i++) {
                $btnVer = '';
                $btnEdit = '';
                $btnElim = '';

                if ($miTabla[$i]['estado'] == 1) {
                    $miTabla[$i]['estado'] = '<div class="text-center"><span class="badge badge-success">Activado</span></div>';
                } else {
                    $miTabla[$i]['estado'] = '<div class="text-center"><span class="badge badge-danger">Desactivado</span></div>';
                }

                if ($_SESSION['permisosMod']['r']){
                    $btnVer = '<button type="button" class="btn btn-secondary btn-sm" data-operacion="ver" data-id="'.$miTabla[$i]['idempresa'].'" title="Ver perfil">
											<i class="icon-copy fa fa-eye" aria-hidden="true"></i>
										</button>';

                }

                if ($_SESSION['permisosMod']['u']) {
                   /* if (($_SESSION['idProveedor'] == 'US00000001' && $_SESSION['userData']['idrol'] == 'RL00000001') ||
                        ($_SESSION['userData']['idrol'] == 'RL00000001' && $miTabla[$i]['idrol'] != 'RL00000001')) {*/
                            $btnEdit = '<button type="button" class="btn btn-info btn-sm" data-operacion="editar" data-id="'.$miTabla[$i]['idempresa'].'" title="Editar">
												<i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
											</button>';
                    /*} else {
                        $btnEdit = '<button type="button" class="btn btn-info btn-sm" disabled><i class="icon-copy fa fa-pencil"></i></button>';
                    }*/
                }

                if ($_SESSION['permisosMod']['d']) {
                    /*if (($_SESSION['idProveedor'] == 'US00000001' && $_SESSION['userData']['idrol'] == 'RL00000001') ||
                        ($_SESSION['userData']['idrol'] == 'RL00000001' && $miTabla[$i]['idrol'] != 'RL00000001') &&
                        ($_SESSION['userData']['idProveedor'] != $miTabla[$i]['idProveedor'])) {*/

                        $btnElim = '<button type="button" class="btn btn-danger btn-sm" data-operacion="eliminar" data-id="' . $miTabla[$i]['idempresa'] . '" title="Eliminar">
											<i class="icon-copy fa fa-trash" aria-hidden="true"></i>
										</button>';
                   /* } else {
                        $btnElim = '<button type="button" class="btn btn-danger btn-sm" disabled><i class="icon-copy fa fa-trash"></i></button>';
                    }*/

                }

                $miTabla[$i]['opcion'] = '<div class="text-center">'.$btnVer.' '.$btnEdit.' '.$btnElim.'</div>';

            }

            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getProveedorAdd(){
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->ListarProveedor();
            for ($i = 0; $i < count($miTabla); $i++) {

                if ($_SESSION['permisosMod']['r']) {
                    $btnAdd = '<button type="button" class="btn btn-primary btn-sm" data-operacion="agregar" data-id="' . $miTabla[$i]['idempresa'] . '" title="Agregar proveedor">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                </button>';
                }

                $miTabla[$i]['addproved'] = '<div class="text-center">'.$btnAdd.'</div>';
            }
            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getIdProveedor($idproveedor)
    {
        if ($_SESSION['permisosMod']['r']) {

            $stridProveedor = strClean($idproveedor);

            $arrData = $this->model->seleccionarProveedor($stridProveedor);
            if (empty($arrData)) {
                $arrResponse = array('resultado' => false, 'msg' => 'Datos no encontrados.');
            } else {
                //OBTENEMOS LOS DATOS (URL_RUTA+NOMBRE_IMAGEN)
                $arrData['url_imagen'] = media().'/vendors/images/empresa/'.$arrData['imagen'];
                $arrResponse = array('resultado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delProveedor()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $stridProveedor = strClean($_POST['idproveedor']);
                $requestDelete = $this->model->EliminarProveedor($stridProveedor);

                if ($requestDelete) {
                    $arrResponse = array('resultado' => true, 'msg' => 'Se ha eliminado el proveedor');
                } else {
                    $arrResponse = array('resultado' => false, 'msg' => 'Error al eliminar el proveedor.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }


}

?>
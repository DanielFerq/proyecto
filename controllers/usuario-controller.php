<?php

class usuario extends controllers{

    public function __construct()
    {

        parent::__construct();
        session_start();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('Location: ' .base_url(). '/login');
            die();
        }
        getPermisos('MD00000005');
    }

    public function usuario()
    {

        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" .base_url().'/dashboard');
        }

        $data['page_id'] = 5;
        $data['page_tag'] = "Usuario";
        $data['page_name'] = "usuario";
        $data['page_title'] = "Usuarios - <small> Tienda </small>";
        $data['page_functions_js'] = "function-usuario.js";
        $this->views->getview($this, "usuario-view", $data);
    }

    public function setUsuario(){
        if ($_POST){
            //dep($_POST);
            //dep($_FILES);
            //exit();

            if (empty($_POST['txtnom']) || empty($_POST['txtapell']) || 
                empty($_POST['txtfechanac']) || empty($_POST['txtcorreo']) || 
                empty($_POST['txtdni']) || empty($_POST['cborol']) || empty($_POST['txtuser'])){

                $arrResponse = array("resultado" => false, "msg" => 'Datos incorrectos.');

            } else {
                $idUsuario = strClean($_POST['txtidusuario']);
                $strRol = strClean($_POST['cborol']);
                $strUsuario = strClean($_POST['txtuser']);
                $strNombre = ucwords(strClean($_POST['txtnom']));
                $strApellido = ucwords(strClean($_POST['txtapell']));
                $strDNI = intval(strClean($_POST['txtdni']));
                $strFechanac = strClean($_POST['txtfechanac']);
                $intCel = intval(strClean($_POST['txtcel']));
                $strCorreo = strtolower(strClean($_POST['txtcorreo']));
                $intEstado = intval($_POST['cboestado']);

                $strDirec = "";
                $strDirec2 = "";
                $strRefer = "";

                //OBTENEMOS TODA LA INFO DE LA FOTO
                $foto           = $_FILES['txtfoto'];
                $nombre_foto    = $foto['name'];
                $type           = $foto['type'];
                $url_temp       = $foto['tmp_name'];
                $img            = 'user-default.png';
                $request_usuario = "";
                if($nombre_foto != ''){
                    $img = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
                }


                if ($idUsuario == "") {
                    $option = 1;
                    $strClave = empty($_POST['txtclave2']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtclave2']);

                    if ($_SESSION['permisosMod']['w']) {
                        $request_usuario = $this->model->RegistrarUsuario(
                            $strRol,
                            $strUsuario,
                            $strClave,
                            $strNombre,
                            $strApellido,
                            $strDNI,
                            $strFechanac,
                            $intCel,
                            $img,
                            $strCorreo,
                            $strDirec,
                            $strDirec2,
                            $strRefer,
                            $intEstado
                        );
                    }
                } else {
                    $option = 2;
                    if($nombre_foto == ''){
                        if($_POST['foto_actual'] != 'user-default.png' && $_POST['foto_remove'] == 0 ){
                            $img = $_POST['foto_actual'];
                        }
                    }
                    $strClave = empty($_POST['txtclave2']) ? "" : hash("SHA256", $_POST['txtclave2']);
                    if ($_SESSION['permisosMod']['u']) {
                        $request_usuario = $this->model->ModificarUsuario(
                            $idUsuario,
                            $strRol,
                            $strUsuario,
                            $strClave,
                            $strNombre,
                            $strApellido,
                            $strDNI,
                            $strFechanac,
                            $intCel,
                            $img,
                            $strCorreo,
                            $strDirec,
                            $strDirec2,
                            $strRefer,
                            $intEstado
                        );
                    }

                }

                if ($request_usuario > 0) {
                    if ($option == 1) {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos guardados correctamente.');
                        if($nombre_foto != ''){ uploadImage($foto,$img); }
                    } else {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos Actualizados correctamente.');
                        if($nombre_foto != ''){ uploadImage($foto,$img); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'user-default.png')
                                || ($nombre_foto != '' && $_POST['foto_actual'] != 'user-default.png')){
                                deleteFile($_POST['foto_actual']);
                        }
                    }
                } else if ($request_usuario == 'existe') {
                    $arrResponse = array('resultado' => false, 'msg' => '¡Atención! el correo o la identificación ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("resultado" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getUsuarios()
    {
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->ListarUsuarios();
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
                    $btnVer = '<button type="button" class="btn btn-secondary btn-sm" data-operacion="ver" data-id="'.$miTabla[$i]['idusuario'].'" title="Ver perfil">
											<i class="icon-copy fa fa-eye" aria-hidden="true"></i>
										</button>';

                }

                if ($_SESSION['permisosMod']['u']) {
                   /* if (($_SESSION['idusuario'] == 'US00000001' && $_SESSION['userData']['idrol'] == 'RL00000001') ||
                        ($_SESSION['userData']['idrol'] == 'RL00000001' && $miTabla[$i]['idrol'] != 'RL00000001')) {*/
                            $btnEdit = '<button type="button" class="btn btn-info btn-sm" data-operacion="editar" data-id="'.$miTabla[$i]['idusuario'].'" title="Editar">
												<i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
											</button>';
                    /*} else {
                        $btnEdit = '<button type="button" class="btn btn-info btn-sm" disabled><i class="icon-copy fa fa-pencil"></i></button>';
                    }*/
                }

                if ($_SESSION['permisosMod']['d']) {
                    /*if (($_SESSION['idusuario'] == 'US00000001' && $_SESSION['userData']['idrol'] == 'RL00000001') ||
                        ($_SESSION['userData']['idrol'] == 'RL00000001' && $miTabla[$i]['idrol'] != 'RL00000001') &&
                        ($_SESSION['userData']['idusuario'] != $miTabla[$i]['idusuario'])) {*/

                        $btnElim = '<button type="button" class="btn btn-danger btn-sm" data-operacion="eliminar" data-id="' . $miTabla[$i]['idusuario'] . '" title="Eliminar">
											<i class="icon-copy fa fa-trash" aria-hidden="true"></i>
										</button>';
                   /* } else {
                        $btnElim = '<button type="button" class="btn btn-danger btn-sm" disabled><i class="icon-copy fa fa-trash"></i></button>';
                    }*/

                }

                $miTabla[$i]['opcion'] = '<div class="table-actions btn-list">'.$btnVer.' '.$btnEdit.' '.$btnElim.'</div>';

            }

            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getIdUsuario($idusuario)
    {
        if ($_SESSION['permisosMod']['r']) {

            $strIdUsuario = strClean($idusuario);

            $arrData = $this->model->seleccionarUsuario($strIdUsuario);
            if (empty($arrData)) {
                $arrResponse = array('resultado' => false, 'msg' => 'Datos no encontrados.');
            } else {
                //OBTENEMOS LOS DATOS (URL_RUTA+NOMBRE_IMAGEN)
                $arrData['url_imagen'] = media().'/vendors/images/usuario/'.$arrData['imagen'];
                $arrResponse = array('resultado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delUsuario()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $strIdUsuario = strClean($_POST['idusuario']);
                $requestDelete = $this->model->EliminarUsuario($strIdUsuario);

                if ($requestDelete) {
                    $arrResponse = array('resultado' => true, 'msg' => 'Se ha eliminado el usuario');
                } else {
                    $arrResponse = array('resultado' => false, 'msg' => 'Error al eliminar el usuario.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function perfil()
    {
        $data['page_tag'] = "Perfil";
        $data['page_name'] = "perfil";
        $data['page_title'] = "Usuarios - <small> Tienda </small>";
        $data['page_functions_js'] = "function-usuario.js";
        $this->views->getview($this, "perfil-view", $data);
    }

}

?>
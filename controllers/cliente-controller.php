<?php
class cliente extends controllers{

    public function __construct()
    {

        parent::__construct();
        session_start();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }
        getPermisos("MD00000015");
    }

    public function cliente(){

        if (empty($_SESSION['permisosMod']['r'])) {
            header('Location: ' . base_url() . '/dashboard');
        }

        $data['page_id'] = 15;
        $data['page_tag'] = "cliente";
        $data['page_name'] = "cliente";
        $data['page_title'] = "clientes - <small> Tienda </small>";
        $data['page_functions_js'] = "function-cliente.js";
        $this->views->getview($this, "cliente-view", $data);
    }

    public function setCliente(){
        if ($_POST) {

            if (empty($_POST['txtnom'])) {

                $arrResponse = array("resultado" => false, "msg" => 'Datos incorrectos.');

            } else {
                $idcliente = strClean($_POST['txtidcliente']);
                $strNombre = strtoupper(strClean($_POST['txtnom']));
                $intDNI = intval(strClean($_POST['txtdni']));
                $intRUC = intval(strClean($_POST['txtruc']));
                $strCorreo = strtolower(strClean($_POST['txtcorreo']));
                $strDirec = strClean($_POST['txtdirec']);
                $intCel = intval(strClean($_POST['txtcel']));
                $intEstado = intval($_POST['cboestado']);

                $request_cliente = "";

                if ($idcliente == "") {
                    $option = 1;

                    if ($_SESSION['permisosMod']['w']) {
                        $request_cliente = $this->model->RegistrarCliente(
                            $strNombre,
                            $intDNI,
                            $intRUC,
                            $intCel,
                            $strCorreo,
                            $strDirec,
                            $intEstado
                        );
                    }
                } else {
                    $option = 2;
                    if ($_SESSION['permisosMod']['u']) {
                        $request_cliente = $this->model->ModificarCliente(
                            $idcliente,
                            $strNombre,
                            $intDNI,
                            $intRUC,
                            $intCel,
                            $strCorreo,
                            $strDirec,
                            $intEstado
                        );
                    }

                }

                if ($request_cliente > 0) {
                    if ($option == 1) {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array('resultado' => true, 'msg' => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_cliente == 'existe') {
                    $arrResponse = array('resultado' => false, 'msg' => '¡Atención! el DNI o RUC ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("resultado" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getClientes(){
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->ListarCliente();
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
                    $btnVer = '<button type="button" class="btn btn-secondary btn-sm" data-operacion="ver" data-id="'.$miTabla[$i]['idcliente'].'" title="Ver perfil">
                                            <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                        </button>';

                }

                if ($_SESSION['permisosMod']['u']) {
                        $btnEdit = '<button type="button" class="btn btn-info btn-sm" data-operacion="editar" data-id="'.$miTabla[$i]['idcliente'].'" title="Editar">
                                        <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                                    </button>';
                    }

                if ($_SESSION['permisosMod']['d']){
                        $btnElim = '<button type="button" class="btn btn-danger btn-sm" data-operacion="eliminar" data-id="' . $miTabla[$i]['idcliente'] . '" title="Eliminar">
                                        <i class="icon-copy fa fa-trash" aria-hidden="true"></i>
                                    </button>';
                    } 

                $miTabla[$i]['opcion'] = '<div class="text-center">'.$btnVer.' '.$btnEdit.' '.$btnElim.'</div>';

            }

            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getIdCliente($idcliente){
        if ($_SESSION['permisosMod']['r']) {

            $stridcliente = strClean($idcliente);

            $arrData = $this->model->SeleccionarCliente($stridcliente);
            if (empty($arrData)) {
                $arrResponse = array('resultado' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('resultado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

        public function delCliente(){
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $stridcliente = strClean($_POST['idcliente']);
                $requestDelete = $this->model->EliminarCliente($stridcliente);

                if ($requestDelete) {
                    $arrResponse = array('resultado' => true, 'msg' => 'Se ha eliminado el cliente');
                } else {
                    $arrResponse = array('resultado' => false, 'msg' => 'Error al eliminar el cliente.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

}

?>
<?php

class producto extends controllers{

    public function __construct(){

        parent::__construct();
        session_start();
        //session_regenerate_id(true);
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
            
        }

        getPermisos('MD00000011');

    }

    public function producto(){
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" .base_url().'/dashboard');
        }

        $data['page_id'] = 11;
        $data['page_tag'] = "Productos";
        $data['page_name'] = "producto";
        $data['page_title'] = "Producto - <small> Tienda </small>";
        $data['page_functions_js'] = "function-producto.js";
        $this->views->getview($this, "producto-view", $data);
    }

    public function setProducto(){
        if ($_POST) {
            /*dep($_POST);
            die();*/
            if (empty($_POST['txtcod']) || empty($_POST['txtsku']) || empty($_POST['txtnom']) || 
                empty($_POST['cboCat']) || empty($_POST['cbomarca']) || empty($_POST['txtmodel']) || 
                empty($_POST['txtpcompra']) || empty($_POST['txtpventa']) || empty($_POST['txtstock']) || 
                empty($_POST['txtstockmin']) || empty($_POST['txtdescuento']) || empty($_POST['txtdescuento']) || 
                empty($_POST['cbopresent']) || empty($_POST['txtdesc'])) {

                $arrResponse = array("resultado" => false, "msg" => 'Datos incorrectos.');

            } else {
                $stridProducto = strClean($_POST['txtidproducto']);
                $strCodigo = strClean($_POST['txtcod']);
                $strSku = strClean($_POST['txtsku']);
                $strNombre = strClean($_POST['txtnom']);
                $strCategoria = strClean($_POST['cboCat']);
                $strMarca = strClean($_POST['cbomarca']);
                $strModelo = strClean($_POST['txtmodel']);
                $strPcompra = strClean($_POST['txtpcompra']);
                $strPventa = strClean($_POST['txtpventa']);
                $strStock = strClean($_POST['txtstock']);
                $strStockmin = strClean($_POST['txtstockmin']);
                $strDescuento = strClean($_POST['txtdescuento']);
                $intTipop = intval(strClean($_POST['cbotprod']));
                $strPresentacion = strClean($_POST['cbopresent']);
                $strDescripcion = strClean($_POST['txtdesc']);
                //$strPortada = "N";
                $intEstado = intval($_POST['cboestado']);

                   //OBTENEMOS TODA LA INFO DE LA FOTO
                $foto           = $_FILES['txtfoto'];
                $nombre_foto    = $foto['name'];
                $type           = $foto['type'];
                $url_temp       = $foto['tmp_name'];
                $img            = 'producto-default.png';
                $request_producto = "";
                if($nombre_foto != ''){
                    $img = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
                }



                if ($stridProducto == "") {
                    $option = 1;

                    if ($_SESSION['permisosMod']['w']) {
                        $request_producto = $this->model->RegistrarProductos(
                            $strMarca,
                            $strCategoria,
                            $strPresentacion,
                            $strCodigo,
                            $strSku,
                            $strNombre,
                            $strDescripcion,
                            $intTipop,
                            $strStock,
                            $strStockmin,
                            $strPcompra,
                            $strPventa,
                            $strDescuento,
                            $strModelo,
                            $img,
                            $intEstado,
                        );
                    }
                } else {
                    $option = 2;
                    if($nombre_foto == ''){
                        if($_POST['foto_actual'] != 'producto-default.png' && $_POST['foto_remove'] == 0 ){
                            $img = $_POST['foto_actual'];
                        }
                    }
                    if ($_SESSION['permisosMod']['u']) {
                        $request_producto = $this->model->ModificarProductos(
                            $stridProducto,
                            $strMarca,
                            $strCategoria,
                            $strPresentacion,
                            $strCodigo,
                            $strSku,
                            $strNombre,
                            $strDescripcion,
                            $intTipop,
                            $strStock,
                            $strStockmin,
                            $strPcompra,
                            $strPventa,
                            $strDescuento,
                            $strModelo,
                            $img,
                            $intEstado,
                        );
                    }

                }

                if ($request_producto > 0) {
                    if ($option == 1) {
                        $arrResponse = array('resultado' => true, /*'idproducto' => $request_producto,*/ 'msg' => 'Datos guardados correctamente.');
                         if($nombre_foto != ''){ uploadImageProducto($foto,$img); }
                    } else {
                        $arrResponse = array('resultado' => true, /*'idproducto' => $stridProducto,*/ 'msg' => 'Datos Actualizados correctamente.');
                        if($nombre_foto != ''){ uploadImageProducto($foto,$img); }

                        if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'producto-default.png')
                            || ($nombre_foto != '' && $_POST['foto_actual'] != 'producto-default.png')){
                            deleteFileProducto($_POST['foto_actual']);
                        }
                    }
                } else if ($request_producto == 'existe') {
                    $arrResponse = array('resultado' => false, 'msg' => '¡Atención! el código de barra o producto ya existe, ingrese otro.');
                } else {
                    $arrResponse = array("resultado" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getProducto(){
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->ListarProductos();
            for ($i = 0; $i < count($miTabla); $i++) {
                $btnImg = '';
                $btnVer = '';
                $btnEdit = '';
                $btnElim = '';

                if ($miTabla[$i]['estado'] == 1) {
                    $miTabla[$i]['estado'] = '<div class="text-center"><span class="badge badge-success">Activado</span></div>';
                } else {
                    $miTabla[$i]['estado'] = '<div class="text-center"><span class="badge badge-danger">Desactivado</span></div>';
                }

            $miTabla[$i]['preciocompra'] = SMONEY.' '.formatMoney($miTabla[$i]['preciocompra']);
            $miTabla[$i]['precioventa'] = SMONEY.' '.formatMoney($miTabla[$i]['precioventa']);

                if ($_SESSION['permisosMod']['r']) {
                    $btnImg = '<button type="button" class="btn btn-warning btn-sm" data-operacion="imagen" data-id="' . $miTabla[$i]['idproducto'] . '" title="Álbum de imagenes">
                                    <i class="icon-copy bi bi-images" aria-hidden="true"></i>
                                </button>';
                }


                if ($_SESSION['permisosMod']['r']) {
                    $btnVer = '<button type="button" class="btn btn-secondary btn-sm" data-operacion="ver" data-id="' . $miTabla[$i]['idproducto'] . '" title="Ver">
                                <i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                </button>';

                }

                if ($_SESSION['permisosMod']['u']) {
                    $btnEdit = '<button type="button" class="btn btn-info btn-sm" data-operacion="editar" data-id="' . $miTabla[$i]['idproducto'] . '" title="Editar">
                                    <i class="icon-copy fa fa-pencil" aria-hidden="true"></i>
                                </button>';
                }

                if ($_SESSION['permisosMod']['d']) {
                    $btnElim = '<button type="button" class="btn btn-danger btn-sm" data-operacion="eliminar" data-id="' . $miTabla[$i]['idproducto'] . '" title="Eliminar">
                                    <i class="icon-copy fa fa-trash" aria-hidden="true"></i>
                                </button>';
                }

                $miTabla[$i]['opcion'] = '<div class="text-center">'.$btnImg.' '.$btnVer.' '.$btnEdit.' '.$btnElim.'</div>';

            }

            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getProductoCart(){
        if ($_SESSION['permisosMod']['r']) {
            $miTabla = $this->model->ListarProductos();
            for ($i = 0; $i < count($miTabla); $i++) {
 
                if ($miTabla[$i]['stock'] <= $miTabla[$i]['stockmin']) {
                    $miTabla[$i]['cantidad'] = '<span class="badge badge-danger">'.$miTabla[$i]['stock'].'</span>';
                } else {
                    $miTabla[$i]['cantidad'] = '<span class="badge badge-success">'.$miTabla[$i]['stock'].'</span>';
                }

                $miTabla[$i]['precioventa'] = SMONEY.' '.formatMoney($miTabla[$i]['precioventa']);

                if ($_SESSION['permisosMod']['r']) {
                    $btnCart = '<button type="button" class="btn btn-primary btn-sm" data-operacion="agregar" data-id="' . $miTabla[$i]['idproducto'] . '" title="Agregar producto">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                </button>';
                }

                $miTabla[$i]['addcart'] = '<div class="text-center">'.$btnCart.'</div>';
            }
            echo json_encode($miTabla, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getIdProducto($idproducto){
        if ($_SESSION['permisosMod']['r']) {
            $stridProducto = strClean($idproducto);
            $arrData = $this->model->seleccionarProducto($stridProducto);
            if (empty($arrData)) {
                $arrResponse = array('resultado' => false, 'msg' => 'Datos no encontrados.');
            } else {
                //OBTENEMOS LOS DATOS (URL_RUTA+NOMBRE_IMAGEN)
                $arrData['url_imagen'] = media().'/vendors/images/producto/'.$arrData['portada'];
                $arrResponse = array('resultado' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setImage(){
        dep($_POST);

/*        if($_POST){
            if(empty($_POST['idproducto'])){
                $arrResponse = array('resultado' => false, 'msg' => 'Error de dato.');
            }else{
                $idProducto = intval($_POST['idproducto']);
                $foto      = $_FILES['foto'];
                $imgNombre = 'pro_'.md5(date('d-m-Y H:m:s')).'.jpg';
                $request_image = $this->model->insertImage($idProducto,$imgNombre);
                if($request_image){
                    $uploadImage = uploadImage($foto,$imgNombre);
                    $arrResponse = array('resultado' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
                }else{
                    $arrResponse = array('resultado' => false, 'msg' => 'Error de carga.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }*/
        die();
    }

  /*  public function delFile(){
        if($_POST){
            if(empty($_POST['idproducto']) || empty($_POST['file'])){
                $arrResponse = array("resultado" => false, "msg" => 'Datos incorrectos.');
            }else{
                //Eliminar de la DB
                $idProducto = intval($_POST['idproducto']);
                $imgNombre  = strClean($_POST['file']);
                $request_image = $this->model->deleteImage($idProducto,$imgNombre);

                if($request_image){
                    $deleteFile =  deleteFile($imgNombre);
                    $arrResponse = array('resultado' => true, 'msg' => 'Archivo eliminado');
                }else{
                    $arrResponse = array('resultado' => false, 'msg' => 'Error al eliminar');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }*/

    public function delProducto(){
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) {
                $stridProducto = strClean($_POST['idproducto']);
                $requestDelete = $this->model->EliminarProducto($stridProducto);
                if ($requestDelete) {
                    $arrResponse = array('resultado' => true, 'msg' => 'Se ha eliminado el producto');
                } else {
                    $arrResponse = array('resultado' => false, 'msg' => 'Error al eliminar el producto.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    //BUSCAR PRODUCTOS X CODIGO
    public function buscarxCodigo($valor){
        //if ($_POST) {
                //$stridProducto = intval($_POST['idproducto']);
                $arrData = $this->model->BuscarPorCodigo($valor);
               /*  if (empty($arrData)) {
                    $arrResponse = array('resultado' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrResponse = array('resultado' => true, 'data' => $arrData); 
                } */
                echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
       // }
        die();
    }

    //BUSCAR PRODUCTOS X NOMBRE
    public function buscarxNombre(){
        $arrData = array();
        $valor = $_GET['term'];
        $data = $this->model->BuscarPorNombre($valor);
        foreach ($data as $row) {
            $result['id'] = $row['id'];
            $result['label'] = $row['nombreproducto'];
            array_push($arrData, $result);
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

}

?>
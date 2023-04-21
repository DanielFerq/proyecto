<?php

require 'vendor/autoload.php';
use Dompdf\Dompdf;
class compra extends controllers{

    //public  $idusuario = $_SESSION['userData']['idusuario'];

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

    public function compra(){

        if (empty($_SESSION['permisosMod']['r'])) {
            header('Location: ' . base_url() . '/dashboard');
        }

        $data['page_id'] = 15;
        $data['page_tag'] = "Compra";
        $data['page_name'] = "compra";
        $data['page_title'] = "compras - <small> Tienda </small>";
        $data['page_functions_js'] = "function-compra.js";
        $this->views->getview($this, "compra-view", $data);
    }


    public function addCart($idproducto_){

        $idusuario = $_SESSION['userData']['idusuario'];
        
        if ($_SESSION['permisosMod']['r']) {
            $stridProducto = strClean($idproducto_);
           
            //Consultar Producto x ID
            $arrDataProd = $this->model->SeleccionarProducto($stridProducto);
            $idproducto =  $arrDataProd['idproducto'];
            $cantidad = 1;
            $precio =  $arrDataProd['precioventa'];

            //Consultar temporal Compra
            $arrDataTemp = $this->model->SeleccionarTempCompra($idproducto,$idusuario);

            if (empty($arrDataTemp)) {
                $temp = $this->model->RegistrarTempCompra($idusuario, $idproducto, $cantidad, $precio);
                if ($temp) {
                    $arrResponse = array('resultado' => true,'tipo' => 'success', 'msg' => 'PRODUCTO AGREGADO AL CARRITO');
                } else {
                    $arrResponse = array('resultado' => false,'tipo' => 'error', 'msg' => 'ERROR AL AGREGAR');
                }
            } else {
                $cantidad = $arrDataTemp['cantidad'] + 1;
                $temp = $this->model->ModificarTempCompra($idusuario, $idproducto, $cantidad);
                if ($temp) {
                    $arrResponse = array('resultado' => true,'tipo' => 'success', 'msg' => 'PRODUCTO INCREMENTADO');
                } else {
                    $arrResponse = array('resultado' => false,'tipo' => 'error', 'mensaje' => 'ERROR AL AGREGAR');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //POR PROBAR LA FUNCTION
    public function saveCompra(){
        if ($_POST) {
           /*  dep($_POST);
            exit();  */
            
             $idusuario = $_SESSION['userData']['idusuario'];
            
            if ($_SESSION['permisosMod']['r']) {
                $idproveedor = strClean($_POST['idproveedor']);
                $serie = strClean($_POST['serie']);

                $consultar = $this->model->SeleccionarProductoId($idusuario);

                if(empty($consultar)){
                    $arrResponse = array('resultado' => false,'tipo' => 'error', 'msg' => 'CARRITO VACIO');
                }else{
                    $total = 0.00;
                    foreach ($consultar as $temp) {
                        $total += $temp['cantidad'] * $temp['precio'];
                    }
                    $saveRegistro = $this->model->RegistrarCompra($idusuario,$idproveedor,$serie,$total);
                    $idcompra = $saveRegistro->_idcompra;
                    
                    if($idcompra > 0){
                        foreach ($consultar as $temp) {
                            //Registra detalle de compra
                            $this->model->RegistrarDetalleCompra($idcompra,$temp['idproducto'],$temp['cantidad'],$temp['precio']);
                            
                            //Obtener el id producto
                            $producto = $this->model->SeleccionarProducto($temp['idproducto']);

                            //Sumar stock del bd + cantidad ingresada --> MODIFICAR
                            $stock = $producto['stock'] + $temp['cantidad'];
                            $this->model->ModificarStockProducto($temp['idproducto'],$stock);
                         }
                        $this->model->EliminarProductoId($idusuario);
                        $arrResponse = array('resultado' => true,'tipo' => 'success', 'msg' => 'Ok', 'shoping' => $idcompra);
                    }else{
                        $arrResponse = array('resultado' => false,'tipo' => 'error', 'msg' => 'Error');
                    } 
                
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function reporteCompra($datos){
        // instantiate and use the dompdf class
        ob_start();
        $array = explode(',', $datos);
        $tipo = $array[0];
        $idcompra = $array[1];

        $data['title'] = 'Reporte de compra';
        $data['empresa'] = $this->model->getEmpresa();
        $data['compra'] = $this->model->getCompra($idcompra);
        if (empty($data['compra'])) {
            echo 'Pagina no Encontrada';
            exit;
        }

        $this->views->getView('compras', $tipo, $data);
        $html = ob_get_clean();

        $dompdf = new Dompdf();
        
        $options = $dompdf->getOptions();
        $options->set('isJavascriptEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        if($tipo == 'ticked'){       
            $dompdf->setPaper(array(0,0, 222, 841), 'portrait');
        }else{
            $dompdf->setPaper('A4','vertical');
        }

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('ticked.pdf', array('Attachment' => false));
    }
    
    
    public function listarTemp(){
        $idusuario = $_SESSION['userData']['idusuario'];

        if ($_SESSION['permisosMod']['r']) {
            $arrData = $this->model->SeleccionarProductoId($idusuario);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    } 

    public function delTempCompra($idtempcompra){
        if ($_SESSION['permisosMod']['d']) {
            $stridtempcompra = strClean($idtempcompra);
            $requestDelete = $this->model->EliminarTempCompra($stridtempcompra);

            if ($requestDelete) {
                $arrResponse = array('resultado' => true, 'tipo' => 'success', 'msg' => 'PRODUCTO ELIMINADO');
            } else {
                $arrResponse = array('resultado' => false, 'tipo' => 'error', 'msg' => 'ERROR AL ELIMINAR');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function addTempCantidad(){
        if ($_POST) {
            /*     dep($_POST);
            exit(); */
            if ($_SESSION['permisosMod']['r']) {
                $idtempcompra = strClean($_POST['idtempcompra']);
                $cantidad = intval($_POST['cantidad']);
                $arrResponse = $this->model->ModificarCantidad($idtempcompra, $cantidad);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function addTempPrecio(){
        if ($_POST) {
            if ($_SESSION['permisosMod']['r']) {
                $idtempcompra = strClean($_POST['idtempcompra']);
                $precio = floatval($_POST['precio']);
                $arrResponse = $this->model->ModificarPrecio($idtempcompra, $precio);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

}

?>
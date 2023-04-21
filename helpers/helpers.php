<?php 	

//VIDEO 19 min 8
	//RETORNA LA URL DEL PROYECTO
	function base_url(){
		
		return BASE_URL;	
	}

	function media(){
		return BASE_URL."/assets";
	}
	
	//CREAMOS MUESTRA FUNCION PARA OBTENER LA INFORMACIÓN FORMATEADA DE DATA
	function dep($data){

		$format = print_r('<pre>');
		$format .= print_r($data);
		$format .= print_r('</pre>');
		return $format;
	}

    //========================================
    // VISTAS GENERAL
    function headerAdmin($data=""){
        $view_header = "views/template/header-admin.php";
        require_once ($view_header);
    }

    function footerAdmin($data=""){
        $view_footer = "views/template/footer-admin.php";
        require_once ($view_footer);
    }


    //==================TIENDA ======================
    // VISTAS GENERAL
    function headerTienda($data=""){
        $view_header = "views/template/header-tienda.php";
        require_once ($view_header);
    }

    function footerTienda($data=""){
        $view_footer = "views/template/footer-tienda.php";
        require_once ($view_footer);
    }

    //=====================================


    //FUNCION PARA LLAMAR A UN MODAL 
    function getModal(string $nameModal, $data){
        $view_modal = "views/template/modals/{$nameModal}.php";
        require_once ($view_modal);
    }

    //Envio de correos
    function sendCorreo($data,$template){
        $asunto = $data['asunto'];
        $correoDestino = $data['correo'];
        $empresa = NOMBRE_REMITENTE;
        $remitente = EMAIL_REMITENTE;
        //ENVIO DE CORREO
        $de = "MIME-Version: 1.0\r\n";
        $de .= "Content-type: text/html; charset=UTF-8\r\n";
        $de .= "From: {$empresa} <{$remitente}>\r\n";
        ob_start();
        require_once("views/template/correo/".$template.".php");
        $mensaje = ob_get_clean();
        $send = mail($correoDestino, $asunto, $mensaje, $de);
        return $send;
    }

    function getPermisos(string $idmodulo){
        require_once ("models/permiso_model.php");
        $objPermisos = new permiso_Model();
        $idrol = $_SESSION['userData']['idrol'];
        $arrPermisos = $objPermisos->permisosModulo($idrol);
        $permisos = '';
        $permisosMod = '';
        if(count($arrPermisos) > 0 ){
            $permisos = $arrPermisos;
            $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
        }
        $_SESSION['permisos'] = $permisos;
        $_SESSION['permisosMod'] = $permisosMod;
    }

    function sessionUsuario(string $idusuario){
        require_once ("models/login_model.php");
        $objLogin = new login_Model();
        $request = $objLogin->sessionLogin($idusuario);
        return $request;
    }

//================== MODAL USUARIO ======================
    function uploadImage(array $data, string $name){
        $url_temp = $data['tmp_name'];
        $destino    = 'assets/vendors/images/usuario/'.$name;        
        $move = move_uploaded_file($url_temp, $destino);
        return $move;
    }

    function deleteFile(string $name){
        unlink('assets/vendors/images/usuario/'.$name);
    }

//================== MODAL PRODUCTOS ======================
    function uploadImageProducto(array $data, string $name){
        $url_temp = $data['tmp_name'];
        $destino    = 'assets/vendors/images/producto/'.$name;        
        $move = move_uploaded_file($url_temp, $destino);
        return $move;
    }

    function deleteFileProducto(string $name){
        unlink('assets/vendors/images/producto/'.$name);
    }

    //================== MODAL PROVEEDOR ======================
    function uploadImageProveedor(array $data, string $name){
        $url_temp = $data['tmp_name'];
        $destino    = 'assets/vendors/images/empresa/'.$name;        
        $move = move_uploaded_file($url_temp, $destino);
        return $move;
    }

    function deleteFileProveedor(string $name){
        unlink('assets/vendors/images/empresa/'.$name);
    }

	//Elimina exceso de espacios entre palabras
    function strClean($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;
    }

    //Genera una contraseña de 10 caracteres
	function passGenerator($length = 10)
    {
        $pass = "";
        $longitudPass=$length;
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);

        for($i=1; $i<=$longitudPass; $i++)
        {
            $pos = rand(0,$longitudCadena-1);
            $pass .= substr($cadena,$pos,1);
        }
        return $pass;
    }
    //Genera un token
    function token()
    {
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;
    }
    //Formato para valores monetarios
    function formatMoney($cantidad){
        $cantidad = number_format($cantidad,2,SPD,SPM);
        return $cantidad;
    }
    

 ?>
<?php 
	
	require_once("config/config.php");
	require_once("helpers/helpers.php");

	//SI NO EXISTE, ARROJE EL INICIO 
	$url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';

	//CAPTURAMOS CUANDO ENCUENTRE "/"
	$arrUrl = explode("/", $url);
	
	//INDICAMOS QUE LA POSICION [0] = A CONTROLADOR
	$controller = $arrUrl[0];
	
	//POSICION SIGUIENTE SERÁ METODOS
	$method = $arrUrl[0];

	//LOS RESTOS SERÁN PARAMETROS
	$params = "";


	if(!empty($arrUrl[1])){

		if($arrUrl[1] != ""){

			//ALMACENA LOS METODOS
			$method = $arrUrl[1];
		}
	}

	if (!empty($arrUrl[2])) {
		
		if($arrUrl[2] != ""){
			
			for($i=2; $i < count($arrUrl); $i++){
				
				//ALMACENA LOS PARAMETROS.. INICIO/USUARIOS/LISTA/..
				$params .= $arrUrl[$i].',';
			}

			//ELIMINE LA ULTIMA COMA
			$params = trim($params, ',');
		}
	}

	require_once("libraries/core/autoload.php");

	require_once("libraries/core/load.php");

 ?>
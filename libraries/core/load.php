<?php 
	
	//La primera letra en Mayúscula
	//$controller = ucwords($controller);

	$controllerFile = "controllers/".$controller."-controller.php";
	//echo $controllerFile;

	//SI EXISTE LA RUTA "CONTROLADOR/EJEMPLO.PHP"
	if(file_exists($controllerFile)){

		require_once($controllerFile);
		$controller = new $controller();

		//SI EXISTE EL METODO EN ESTE CONTROLADOR
		if (method_exists($controller, $method)){
			
			//UTILIZAMOS EL METODO POR MEDIO DE LA INSTANCIA CREADA
			//MÉTODO - PARAMETRO
			$controller->{$method}($params);
		}else{
			//echo "No existe el método";
			require_once("controllers/error-controller.php");
		}

	}else{
		//echo "No existe controlador";
		require_once("controllers/error-controller.php");
	}	


 ?>
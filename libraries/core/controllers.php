<?php

class controllers
{

	public function __construct(){

		$this->views = new views();
		$this->loadModel();

	}

	//MÉTODO PARA CARGAR LOS MODELOS
	public function loadModel(){

		//EJEMPLO: home-model
		$model = get_class($this) . "_Model";

		//REFERENCIA A LA CARPETA + EL EJEMPLO 
		//models/home-model.php

		//$ruta_model = get_class($this)

		$routClass = "models/" . $model . ".php";

		//SI EXISTE LA RUTA
		if (file_exists($routClass)) {

			//LLAMAMOS AL MODELO
			require_once($routClass);
			$this->model = new $model();
		}

	}
}

?>
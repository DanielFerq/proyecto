<?php 
	class views{

		//PASAREMOS EL CONTROLADOR MAS LA VISTA DE LA PAG
		function getView($controller,$view, $data=""){

			$controller = get_class($controller);

			if ($controller == "home"){

				//AQUI SE ARMA LA RUTA POR DEFECTO
				$view = VIEWS.$view.".php";

			}else{

				$view = VIEWS.$controller."/".$view.".php";
			}

			require_once($view);
		}
	}

 ?>
<?php 

	spl_autoload_register(function($class){

		//EJEMPLOS: libs/core/home.php
		//SI EXISTE LA RUTA, REQUERIMOS 
		if(file_exists("libraries/".CORE.'/'.$class.".php")){

			require_once("libraries/".CORE.'/'.$class.".php");
		}
	});

?>
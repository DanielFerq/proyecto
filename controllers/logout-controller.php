<?php

	//NOS MANDA A LA PAGINA LOGIN POR DEFECTO
	class logout{
		public function __construct()
		{
			session_start();
			session_unset();
			session_destroy();
			//http://localhost:81/proyecto/login
			header('location: '.base_url().'/login');
			die();
		}
	}
 ?>
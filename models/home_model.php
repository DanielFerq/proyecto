<?php 

	require_once("categoria_model.php");
	class home_Model extends mysql{

		private $objCategoria;
		public function __construct(){
			parent::__construct();
			$this->objCategoria = new categoria_Model();
		}

		public function getCategorias(){
			return $this->objCategoria->ListarCategorias();
		}


	}

 ?>
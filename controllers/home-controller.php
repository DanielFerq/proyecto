<?php 	

	class home extends controllers{

		public function __construct(){

			parent::__construct();

		}

		public function home(){
			//dep($this->model->getCategorias());
			$data['page_tag'] = "DaskApp - Store";
			$data['page_title'] = "DaskApp - Store";
			$data['page_name'] = "tienda_virtual";
			$this->views->getview($this,"home-view", $data);
		}

	}
 ?>
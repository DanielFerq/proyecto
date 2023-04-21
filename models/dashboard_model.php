<?php 

	class dashboard_Model extends mysql{

		public function __construct(){

			parent::__construct();

		}

		public function cantUsuarios(){
			$sql = "SELECT COUNT(*) AS total FROM usuarios WHERE estado !=0";
			$request = $this->Seleccionar($sql);
			$total = $request['total'];
			return $total;
		}

		public function cantClientes(){
			$sql = "SELECT COUNT(*) AS total FROM clientes WHERE estado != 0";
			$request = $this->Seleccionar($sql);
			$total = $request['total'];
			return $total;
		}

		public function cantProductos(){
			$sql = "SELECT COUNT(*) AS total FROM productos WHERE estado != 0 ";
			$request = $this->Seleccionar($sql);
			$total = $request['total'];
			return $total;
		}


	}

 ?>
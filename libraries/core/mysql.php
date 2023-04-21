<?php 

	class mysql extends conexion{

		private $conexion;
		private $string_query;
		private $array_values;
		private $string_data;

		function __construct(){

			$this->conexion = new conexion();
			$this->conexion = $this->conexion->conect();
		}

		//-------------------CREAMOS METODOS GLOBALES---------------

		//REGISTRAR LOS DATOS
		public function Registrar(string $query, array $arrvalues){

			//ALMACENA LOS PARAMETROS
			$this->string_query = $query;
			$this->array_values = $arrvalues;

			//PREPARAMOS LA CONSULTA
			$insertar = $this->conexion->prepare($this->string_query);
			$dato = $insertar->execute($this->array_values);

			//VALIDAMOS SI INSERTÓ LOS DATOS
			if($dato){
				//OBTENER EL ID REGISTRADO EJM. "EMP0001"
				$resultado = $insertar->fetch(PDO::FETCH_OBJ);
			}else{
				$resultado = 0;
			} 
			return $resultado;
		}

		//BUSCA UN REGISTRO
		public function Seleccionar(string $query){
			$this->string_query = $query;
			$resultado = $this->conexion->prepare($this->string_query);
			$resultado->execute();
			$dato = $resultado->fetch(PDO::FETCH_ASSOC);
			return $dato; 
		}

		//DEVUELVE TODO LOS REGISTRO 
		public function Listar(string $query){
			$this->string_query = $query;
			$resultado = $this->conexion->prepare($this->string_query);
			$resultado->execute();
			$dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
			return $dato;
		}

		//ACTUALIZAR LA INFORMACIÓN
		public function Modificar(string $query, array $arrvalues){

			//ALMACENA LOS PARAMETROS
			$this->string_query = $query;
			$this->array_values = $arrvalues;

			$actualizar = $this->conexion->prepare($this->string_query);	
			$dato = $actualizar->execute($this->array_values);
			return $dato;
		}

		//ELIMINAR UN DATO
		public function Eliminar(string $query){
			$this->string_query = $query;
			$resultado = $this->conexion->prepare($this->string_query);
			$dato = $resultado->execute();
			return $dato;
		}

	}

 ?>
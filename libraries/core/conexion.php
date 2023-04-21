<?php

//Se hará a través de una clase
class conexion
{
	private $conect;

	public function __construct()
	{

		$coneccion = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";" . DB_CHARSET . ";";

		try {

			$this->conect = new PDO($coneccion, DB_USER, DB_PASSWORD);
			$this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			//echo "conexión exitosa";
		} catch (Exception $e) {
			$this->conect = "Error de conexión";
			echo "ERROR: " . $e->getMessage();
		}

	}

	public function conect()
	{
		return $this->conect;
	}
}

?>
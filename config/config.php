<?php 
	
	const BASE_URL = "http://localhost:81/proyecto";
	const LIBS = "lib/";
	const CORE = "core/";
	const VIEWS = "views/";
	
	/*----------  ZONA HORARIA  ----------*/
	date_default_timezone_set('America/Lima');

	//DATOS DE CONEXION
	const DB_HOST= "localhost";
	const DB_NAME= "deskapp";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "charset=utf8";

	/*----------  DELIMINADORES DECIMAL Y MILLAR EJ. 23,955.00  ----------*/
	
	const SPD =  ".";
	const SPM = ",";

	/*----------  SIMBOLO DE MONEDA  ----------*/
	
	const SMONEY = "s/.";

	//Datos envio de correo
	const NOMBRE_REMITENTE = "AdminSystem - DeskAPP";
	const EMAIL_REMITENTE = "deskapp@admin.com";
	const NOMBRE_EMPESA = "Sistema de Post-venta";
	const WEB_EMPRESA = "www.deskapp.com";
	

 ?>
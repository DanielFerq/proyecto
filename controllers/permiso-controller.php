  <?php 	

	class permiso extends controllers{

		public function __construct(){

			parent::__construct();

		}


		public function getPermisoRol(string $strIdRol){

			$idRol = strClean($strIdRol);

			if(strlen($idRol) > 0){

				$arrModulos = $this->model->SeleccionarModulo();
				$arrPermisosRol = $this->model->SeleccionarPermisoRol($idRol);

				$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
				$arrPermisoRol = array('idrol' => $idRol);

				if(empty($arrPermisosRol)){

					for ($i=0; $i < count($arrModulos); $i++) { 

						$arrModulos[$i]['permisos'] = $arrPermisos;
					}
				}else{

					for ($i=0; $i < count($arrModulos); $i++) { 

						$arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
						$arrPermisos = array('r' => $arrPermisosRol[$i]['r'],
											 'w' => $arrPermisosRol[$i]['w'],
											 'u' => $arrPermisosRol[$i]['u'],
											 'd' => $arrPermisosRol[$i]['d']
											);

						if($arrModulos[$i]['idmodulo'] == $arrPermisosRol[$i]['idmodulo']){

							$arrModulos[$i]['permisos'] = $arrPermisos;
						}
					}
				}

				$arrPermisoRol['modulos'] = $arrModulos;
					//dep($arrModulos);
				$html = getModal("modal-permiso",$arrPermisoRol);

			}
			die();
		}

		public function setPermiso(){

			if($_POST){
				$Idrol = strClean($_POST['idrol']);
				$modulos = $_POST['modulos'];

				$this->model->EliminarPermisos($Idrol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['idmodulo'];
					$r = empty($modulo['r']) ? 0 : 1;
					$w = empty($modulo['w']) ? 0 : 1;
					$u = empty($modulo['u']) ? 0 : 1;
					$d = empty($modulo['d']) ? 0 : 1;
					$requestPermiso = $this->model->RegistrarPermisos($Idrol, $idModulo, $r, $w, $u, $d);
				}
				if($requestPermiso > 0)
				{
					$arrResponse = array('resultado' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("resultado" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();

		}


	}
?>
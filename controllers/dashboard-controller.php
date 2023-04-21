<?php   

  class dashboard extends controllers{

    public function __construct(){

      parent::__construct();
      session_start();
      //GENERAR ID AUTENTICADOR PARA EVITAR HACK
      //session_regenerate_id(true);
      if(empty($_SESSION['login'])){
        header('Location: '.base_url().'/login');
      }
       getPermisos('MD00000001');

    }

    public function dashboard(){

      $data['page_id'] = 1;
      $data['page_tag'] = "Dashboard - AdmSytem";
      $data['page_title'] = "Dashboard - Tienda";
      $data['page_name'] = "dashboard";
      $data['page_functions_js'] = "function-dashboard.js";
      $data['usuarios'] = $this->model->cantUsuarios();
      $data['clientes'] = $this->model->cantClientes();
      $data['productos'] = $this->model->cantProductos();

      $this->views->getview($this,"dashboard-view", $data);
    }

  }
?>
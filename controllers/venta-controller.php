<?php   

  class venta extends controllers{

    public function __construct(){

      parent::__construct();
      session_start();
      if(empty($_SESSION['login'])){
        header('Location: '.base_url().'/login');
      }
       //getPermisos('MD00000001');

    }

    public function venta(){

      //$data['page_id'] = 1;
      $data['page_tag'] = "Venta";
      $data['page_title'] = "Venta - Tienda";
      $data['page_name'] = "venta";
      $data['page_functions_js'] = "function-venta.js";

      $this->views->getview($this,"venta-view", $data);
    }

  }
?>
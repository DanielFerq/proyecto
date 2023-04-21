
<div class="left-side-bar">

  <div class="brand-logo">
    <a href="dashboard">
      <img src="<?= media(); ?>/vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
      <img src="<?= media(); ?>/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo"/>
    </a>
    <div class="close-sidebar" data-toggle="left-sidebar-close"><i class="ion-close-round"></i></div>
  </div>

  <div class="menu-block customscroll">
    <div class="sidebar-menu"> 
      <ul id="accordion-menu">

        <?php if(!empty($_SESSION['permisos']['MD00000001']['r'])){ ?>

        <li>
          <a href="<?= base_url(); ?>/dashboard" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-house"></span
            ><span class="mtext">Dashboard</span>
          </a>
        </li>
      <?php } ?>

      <?php if(!empty($_SESSION['permisos']['MD00000002']['r']) || 
              !empty($_SESSION['permisos']['MD00000003']['r']) ||
              !empty($_SESSION['permisos']['MD00000004']['r'])){ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">
            <span class="micon bi bi-tags"></span
            ><span class="mtext">Catálagos</span>
          </a>
          <ul class="submenu">
            <?php if(!empty($_SESSION['permisos']['MD00000002']['r'])) { ?>
            <li><a href="<?= base_url(); ?>/clasificacion">Clasificaciones</a></li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos']['MD00000003']['r'])){ ?>
            <li><a href="<?= base_url(); ?>/categoria">Categorias</a></li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos']['MD00000004']['r'])){ ?>
            <li><a href="<?= base_url(); ?>/marca">Marcas</a></li>
          <?php } ?>
          </ul>
        </li>
      <?php } ?>
<!--         <li class="dropdown">
          <a href="#" class="dropdown-toggle">
            <span class="micon bi bi-box-seam"></span>
            <span class="mtext">Productos</span>
          </a>
          <ul class="submenu">
            <li><a href="form-basic.html">Form</a></li>
            <li><a href="advanced-components.html">Advanced Components</a></li>
            <li><a href="form-wizard.html">Form Wizard</a></li>
            <li><a href="html5-editor.html">HTML5 Editor</a></li>
            <li><a href="form-pickers.html">Form Pickers</a></li>
            <li><a href="image-cropper.html">Image Cropper</a></li>
            <li><a href="image-dropzone.html">Image Dropzone</a></li>
          </ul>
        </li> -->

      <?php if( !empty($_SESSION['permisos']['MD00000005']['r']) ||
                !empty($_SESSION['permisos']['MD00000006']['r']) ||
                !empty($_SESSION['permisos']['MD00000007']['r']) ||
                !empty($_SESSION['permisos']['MD00000008']['r'])){ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">
            <span class="micon bi bi-sliders"></span
            ><span class="mtext">Administración</span>
          </a>
          <ul class="submenu">
            <?php if(!empty($_SESSION['permisos']['MD00000005']['r'])) { ?>
            <li><a href="<?= base_url(); ?>/usuario">Usuarios</a></li>
            <?php } ?>
            <?php if(!empty($_SESSION['permisos']['MD00000006']['r'])){ ?>
            <li><a href="<?= base_url(); ?>/rol">Roles</a></li>
            <?php } ?>
            <?php if(!empty($_SESSION['permisos']['MD00000007']['r'])){ ?>
            <li><a href="#">Configuración</a></li>
            <?php } ?>
            <?php if(!empty($_SESSION['permisos']['MD00000008']['r'])){ ?>
            <li><a href="#">Log de Acceso</a></li>
             <?php } ?>
          </ul>
        </li>
      <?php } ?>

     <?php if(  !empty($_SESSION['permisos']['MD00000009']['r']) ||
                !empty($_SESSION['permisos']['MD00000010']['r']) ||
                !empty($_SESSION['permisos']['MD00000011']['r'])){ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">
            <span class="micon bi bi-card-checklist"></span
            ><span class="mtext">Mantenimiento</span>
          </a>
          <ul class="submenu">
            <?php if(!empty($_SESSION['permisos']['MD00000009']['r'])) { ?>
            <li><a href="#">Parámetros</a></li>
             <?php } ?>

            <?php if(!empty($_SESSION['permisos']['MD00000010']['r'])){ ?>
            <li><a href="presentacion">Presentación</a></li>
            <?php } ?>

            <?php if(!empty($_SESSION['permisos']['MD00000011']['r'])){ ?>
            <li><a href="<?= base_url(); ?>/producto">Productos</a></li> 
            <?php } ?>
          </ul>
        </li>
      <?php } ?>

      <?php if(!empty($_SESSION['permisos']['MD00000012']['r'])){ ?>
        <li>
          <a href="<?= base_url(); ?>/cliente" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-people"></span>
            <span class="mtext">Clientes</span>
          </a>
        </li>
      <?php } ?>

      <?php if(!empty($_SESSION['permisos']['MD00000013']['r'])){ ?>
        <li>
          <a href="<?= base_url(); ?>/proveedor" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-truck"></span
            ><span class="mtext">Provedores</span>
          </a>
        </li>
      <?php } ?>
      
      <?php if(!empty($_SESSION['permisos']['MD00000014']['r'])){ ?>
        <li>
          <a href="#" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-house"></span
            ><span class="mtext">Cajas</span>
          </a>
        </li>
      <?php } ?>
      
      <?php if(!empty($_SESSION['permisos']['MD00000015']['r'])){ ?>        
        <li>
          <a href="<?= base_url(); ?>/compra" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-cart"></span
            ><span class="mtext">Compras</span>
          </a>
        </li>
      <?php } ?>
      
      <?php if(!empty($_SESSION['permisos']['MD00000016']['r'])){ ?>        
        <li>
          <a href="<?= base_url(); ?>/venta" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-shop"></span
            ><span class="mtext">Ventas</span>
          </a>
        </li>
      <?php } ?>
      
      <?php if(!empty($_SESSION['permisos']['MD00000017']['r'])){ ?>        
        <li>
          <a href="admin-credito" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-credit-card"></span
            ><span class="mtext">Administrar Créditos</span>
          </a>
        </li>
      <?php } ?>
      
      <?php if(!empty($_SESSION['permisos']['MD00000018']['r'])){ ?>        
        <li>
          <a href="cotizacion" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-card-list"></span
            ><span class="mtext">Cotizaciones</span>
          </a>
        </li>
      <?php } ?>
      
      <?php if(!empty($_SESSION['permisos']['MD00000019']['r'])){ ?>        
        <li>
          <a href="apartado" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-house"></span
            ><span class="mtext">Apartados</span>
          </a>
        </li>
      <?php } ?>
      
      <?php if(!empty($_SESSION['permisos']['MD00000020']['r'])){ ?>        
        <li>
          <a href="kardex" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-file-earmark-text"></span
            ><span class="mtext">Kardex</span>
          </a>
        </li>
      <?php } ?>

      <?php if( !empty($_SESSION['permisos']['MD00000021']['r'])/* ||
                !empty($_SESSION['permisos']['MD00000022']['r']) ||
                !empty($_SESSION['permisos']['MD00000023']['r']) ||
                !empty($_SESSION['permisos']['MD00000024']['r'])*/){ ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">
            <span class="micon bi bi-gear"></span
            ><span class="mtext">Configuración</span>
          </a>
          <ul class="submenu">
            <?php if(!empty($_SESSION['permisos']['MD00000021']['r'])) { ?>
            <li><a href="<?= base_url(); ?>/moneda">Monedas</a></li>
            <?php } ?>
<!--             <?php if(!empty($_SESSION['permisos']['MD00000021']['r'])){ ?>
            <li><a href="<?= base_url(); ?>/rol">Roles</a></li>
            <?php } ?>
            <?php if(!empty($_SESSION['permisos']['MD00000021']['r'])){ ?>
            <li><a href="#">Configuración</a></li>
            <?php } ?>
            <?php if(!empty($_SESSION['permisos']['MD00000022']['r'])){ ?>
            <li><a href="#">Log de Acceso</a></li>
             <?php } ?> -->
          </ul>
        </li>
      <?php } ?>
      
        <li><div class="dropdown-divider"></div></li>
        <li><div class="sidebar-small-cap">Acerca </div></li>
        <li>
          <a href="sitio_web" class="dropdown-toggle no-arrow">
            <span class="micon bi bi-diagram-3"></span
            ><span class="mtext">Sitio Web</span>
          </a>
        </li>

        <li>
          <a href="#" class="dropdown-toggle">
            <span class="micon bi bi-file-pdf"></span
            ><span class="mtext">Documentation</span>
          </a>
          <ul class="submenu">
            <li><a href="introduction.html">Introduction</a></li>
            <li><a href="getting-started.html">Getting Started</a></li>
            <li><a href="color-settings.html">Color Settings</a></li>
            <li>
              <a href="third-party-plugins.html">Third Party Plugins</a>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>

</div>

<div class="mobile-menu-overlay"></div>
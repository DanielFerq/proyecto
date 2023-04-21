<?php
  headerAdmin($data);
  getModal('modal-rol', $data);
?>
<div id="contentAjax"></div>

<div class="main-container" <?php echo $data['page_id']; ?>>
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">

      <div class="page-header">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="title">
              <h4>
                <?php echo $data['page_tag']; ?>
              </h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="dashboard">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  <?php echo $data['page_tag']; ?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="pd-20 card-box mb-30">

        <div class="clearfix mb-20">
          <div class="pull-left">
            <h4 class="text-blue h4">Tabla Roles de Usuario</h4>
          </div>
          <div class="pull-right">
            <button id="btnNuevoRol" name="btnNuevoRol" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRol">
              <i class="nav-icon fa fa-plus"></i> Añadir nuevo
            </button>
          </div>
        </div>

        <div class="pb-20 table-responsive">
          <table id="tableRoles" class="data-table table table-bordered hover nowrap responsive">
            <thead>
              <tr class="text-center thead-dark">
                <th class="table-plus datatable-nosort">ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th class="datatable-nosort">Opción</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

      </div>

    </div>


  </div>
</div>

<?php footerAdmin($data); ?>
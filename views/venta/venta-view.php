<?php
headerAdmin($data);
getModal('modal-marca', $data);
?>

<div class="main-container">
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
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  <?= $data['page_tag']; ?>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-sm-12 col-md-5 mb-30">
          <div class="card card-box">
            <div class="card-body">
              <label>Buscar por:</label>
              <br>
              <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                <label class="btn btn-outline-primary btn-sm">
                  <input type="radio" id="barcode" checked name="buscarProducto"><i class="fa fa-barcode"></i> Barcode
                </label>
                <label class="btn btn-outline-success btn-sm">
                  <input type="radio" id="nombre" name="buscarProducto"><i class="fa fa-list"></i> Nombre
                </label>
              </div>

              <!-- input para buscar codigo -->
              <div class="input-group custom" id="containerCodigo">
                <div class="input-group-prepend custom">
                  <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
                <input class="form-control" type="text" id="buscarProductoCodigo" placeholder="Ingrese Barcode - Enter">
              </div>

              <!-- input para buscar nombre -->
              <div class="input-group d-none custom" id="containerNombre">
                <div class="input-group-prepend custom">
                  <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
                <input class="form-control" type="text" id="buscarProductoNombre" placeholder="Buscar Producto">
              </div>

              <div class="table-responsive">
                <table class="table" id="table_temp" style="width: 100%;">
                  <thead>
                    <tr>
                      <th scope="col">Nombre</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Cant</th>
                      <th scope="col">SubTotal</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>

              <div class="card-box pricing-card-style2">
                <div class="pricing-card-header">
                  <div class="left">
                    <h5>Cliente</h5>
                    <p>Click " + " para agregar</p>
                  </div>
                  <div class="right">
                    <div class="pricing-price">
                      <button id="btnAddProveedor" type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#modalProveedor">
                        <i class="nav-icon fa fa-plus"></i>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="pricing-card-body">

                  <form action="">
                    <div class="form-group">
                      <label>Nombres:</label>
                      <input id="txtNom" class="form-control" type="text" placeholder="" disabled>
                    </div>
                    <!--  <div class="form-group">
                      <label>Celular:</label>
                      <input id="txtCel" class="form-control" type="text" placeholder="999-999-999" disabled>
                    </div> -->
                    <div class="form-group">
                      <label>Dirección:</label>
                      <input id="txtDirec" class="form-control" type="text" placeholder="Av." disabled>
                    </div>

                    <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label>Descuento:</label>
                          <input id="txtDesc" class="form-control" type="number" min="0" placeholder="0" value="0">
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label>Total a pagar:</label>
                          <input id="txtTPagar" class="form-control" type="number" min="0" placeholder="0" value="0">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="">Método de pago:</label>
                      <div class="">
                        <select class="custom-select col-12">
                          <option value="1">Efectivo</option>
                          <option value="2">Transferencia</option>
                          <option value="2">Depósito</option>
                          <option value="3">Yape</option>
                          <option value="3">Plin</option>
                          <option value="4">Otros</option>
                        </select>
                      </div>
                    </div>

                  </form>
                </div>

              </div>

              <div class="modal-footer justify-content-between">
                <button id="btnCerrar" type="button" class="btn btn-secondary" data-dismiss="modal">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btnGuardar">
                  <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText"> Guardar</span>
                </button>
              </div>

            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-7 mb-30">
          <div class="card card-box">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table" id="table_venta" style="width: 100%;">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Barcode</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Stock</th>
                          <th scope="col">Precio</th>
                          <th>Accion</th>
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
        </div>

      </div>

    </div>
  </div>
</div>

<?php footerAdmin($data); ?>
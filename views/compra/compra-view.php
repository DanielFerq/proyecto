<?php
headerAdmin($data);
getModal('modal-listproveedor', $data);
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
                                    <?php echo $data['page_tag']; ?>
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
                                    <input type="radio" id="barcode" checked name="buscarProducto"><i
                                        class="fa fa-barcode"></i>
                                    Barcode
                                </label>
                                <label class="btn btn-outline-success btn-sm">
                                    <input type="radio" id="nombre" name="buscarProducto"><i class="fa fa-list"></i>
                                    Nombre
                                </label>
                            </div>

                            <!-- input para buscar codigo -->
                            <div class="input-group custom" id="containerCodigo">
                                <div class="input-group-prepend custom">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <input class="form-control" type="text" id="buscarProductoCodigo"
                                    placeholder="Ingrese Barcode - Enter">
                            </div>

                            <!-- input para buscar nombre -->
                            <div class="input-group d-none custom" id="containerNombre">
                                <div class="input-group-prepend custom">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <input class="form-control" type="text" id="buscarProductoNombre"
                                    placeholder="Buscar Producto">
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_temp" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center thead-dark">
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th width="3%">Cantidad</th>
                                            <th>SubTotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <br>

                            <div class="row">
                                    <div class="pricing-card-style2">
                                        <div class="pricing-card-header">
                                            <div class="left">
                                                <h5>Proveedor</h5>
                                                <p>Click " + " para seleccionar</p>
                                            </div>
                                            <div class="right">
                                                <div class="pricing-price">
                                                    <button id="btnAddProveedor" type="button"
                                                        class="btn btn-sm btn-primary" data-toggle="modal"
                                                        data-target="#modal_listProveedor">
                                                        <i class="nav-icon fa fa-search"></i> Proveedor
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pricing-card-body">
                                            <input type="hidden" id="txtidproveedor" name="txtidproveedor" value="">
                                            <div class="form-group">
                                                <label for="viewNom">Nombres:</label>
                                                <input id="viewNom" name="viewNom" class="form-control" type="text"
                                                    placeholder="" disabled>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="viewCel">Celular:</label>
                                                        <input id="viewCel" name="viewCel" class="form-control" type="text"
                                                            placeholder="999-999-999" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="viewCorr">Correo:</label>
                                                        <input id="viewCorr" name="viewCorr" class="form-control" type="email"
                                                            placeholder="example@gmail.com" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="viewUser">Comprador:</label>
                                                <input id="viewUser" name="viewUser" class="form-control" type="text"
                                                    placeholder="unknow" value="<?= $_SESSION['userData']['nombres'] ?>"
                                                    disabled>
                                            </div> -->
                                             <div class="form-group">
                                                <label for="txtSerie">Serie:</label>
                                                <input id="txtSerie" name="txtSerie" class="form-control" type="text"
                                                    placeholder="ABC00-00" value="">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button id="btnCerrar" type="button" class="btn btn-secondary" data-dismiss="modal">
                                    <i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary" id="btnSaveCompra">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">
                                        Registrar Compra</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 mb-30">
                    <div class="card card-box">
                        <div class="card-body">
                            <label>Tabla de productos:</label>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="data-table table nowrap dataTable no-footer dtr-inline"
                                            id="tableCompra" style="width: 100%;">
                                            <thead class="thead-dark">
                                                <tr role="row">
                                                    <th scope="col">Barcode</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Stock</th>
                                                    <th scope="col">Precio</th>
                                                    <th>Acción</th>
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
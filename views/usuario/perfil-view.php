<?php headerAdmin($data); ?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><?php echo $data['page_tag']; ?></h4>
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

            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">
                            <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i
                                    class="fa fa-pencil"></i></a>
                            <img src="<?= media(); ?>/vendors/images/photo1.jpg" alt="" class="avatar-photo" />

                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body pd-5">
                                            <div class="img-container">
                                                <img id="image" src="<?= media(); ?>/vendors/images/photo2.jpg"
                                                    alt="Picture" />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" value="Update" class="btn btn-primary" />
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <h5 class="text-center h5 mb-0">
                            <?= $_SESSION['userData']['nombres'].' '.$_SESSION['userData']['apellidos']; ?></h5>
                        <p class="text-center text-muted font-14" id="pfviewRol">
                            <?= $_SESSION['userData']['nombrerol']?></p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Información del contacto</h5>
                            <ul>
                                <li><span>Nombre de usuario:</span><?=  $_SESSION['userData']['nombreusuario'] ?></li>
                                <li><span>Correo:</span><?=  $_SESSION['userData']['correo'] ?></li>
                                <li><span>Celular:</span><?=  $_SESSION['userData']['celular'] ?></li>
                                <li><span>Fecha de nacimiento:</span><?=  $_SESSION['userData']['fechanac'] ?></li>
                                <li><span>Dirección:</span>Chincha<br />Ica - Perú</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">
                        <div class="profile-tab height-100-p">
                            <div class="tab height-100-p">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#setting"
                                            role="tab">Configurar información</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#timeline" role="tab">Acceso</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tasks" role="tab">Redes
                                            Sociales</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Timeline Tab start -->
                                    <div class="tab-pane fade" id="timeline" role="tabpanel">
                                        <div class="pd-20">
                                            <div class="profile-timeline">
                                                <form action="">
                                                    <ul class="profile-edit-list" style="padding-bottom: 20px">
                                                        <div class="form-group row">
                                                            <label for="inputPassword"
                                                                class="col-md-4 col-form-label">ID usuario:</label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control"
                                                                    id="inputPassword"
                                                                    value="<?= $_SESSION['userData']['nombreusuario'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputPassword"
                                                                class="col-md-4 col-form-label">Nueva
                                                                contraseña:</label>
                                                            <div class="col-md-8">
                                                                <input type="password" class="form-control"
                                                                    id="inputPassword"
                                                                    placeholder="Escribir su nueva contraseña">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputPassword"
                                                                class="col-md-4 col-form-label">Repetir
                                                                contraseña:</label>
                                                            <div class="col-md-8">
                                                                <input type="password" class="form-control"
                                                                    id="inputPassword"
                                                                    placeholder="Repetir su nueva contraseña">
                                                            </div>
                                                        </div>
                                                    </ul>

                                                    <div class="modal-footer justify-content-between">
                                                        <button id="btnCerrar" type="button" class="btn btn-secondary">
                                                            <i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="">
                                                                Guardar</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Timeline Tab End -->

                                    <!-- Tasks Tab start -->
                                    <div class="tab-pane fade" id="tasks" role="tabpanel">
                                        <div class="pd-20 profile-task-wrap">
                                            <div class="container pd-0">

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tasks Tab End -->

                                    <!-- Setting Tab start -->
                                    <div class="tab-pane fade show active height-100-p" id="setting" role="tabpanel">
                                        <div class="profile-setting">
                                            <form>
                                                <ul class="profile-edit-list row" style="padding-bottom: 0px">
                                                    <li class="weight-500 col-md-6" style="padding-bottom: 0px">
                                                        <div class="form-group">
                                                            <label>Nombres:</label>
                                                            <input class="form-control form-control-lg"
                                                                value="<?= $_SESSION['userData']['nombres'] ?>"
                                                                type="text" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Apellidos:</label>
                                                            <input class="form-control form-control-lg"
                                                                value="<?= $_SESSION['userData']['apellidos'] ?>"
                                                                type="text" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Género:</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-20">
                                                                    <input type="radio" id="customRadio4"
                                                                        name="customRadio"
                                                                        class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="customRadio4">Masculino</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="customRadio5"
                                                                        name="customRadio"
                                                                        class="custom-control-input" />
                                                                    <label class="custom-control-label weight-400"
                                                                        for="customRadio5">Femenino</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>DNI:</label>
                                                            <input class="form-control form-control-lg"
                                                                value="<?= $_SESSION['userData']['dni'] ?>"
                                                                type="text"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Celular:</label>
                                                            <input class="form-control form-control-lg"
                                                                value="<?= $_SESSION['userData']['celular'] ?>"
                                                                type="text" />
                                                        </div>
                                                    </li>

                                                    <li class="weight-500 col-md-6">
                                                        <div class="form-group">
                                                            <label>Correo:</label>
                                                            <input class="form-control form-control-lg"
                                                                value="<?= $_SESSION['userData']['correo'] ?>"
                                                                type="email" placeholder="ejem@gmail.com"  />
                                                        </div>
                                                        <div class="form-group">
                                                            <label>País:</label>
                                                            <select class="form-control form-control-lg">
                                                                <option>Perú</option>
                                                                <option>Chile</option>
                                                                <option>España</option>
                                                                <option>México</option>
                                                                <option>Colombia</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Dirección:</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                placeholder="Av. Call. " />
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="cboestadoPerfil">Estado:</label>
                                                            <select id="cboestadoPerfil" name="cboestado"
                                                                class="form-control form-control-lg" required="">
                                                                <option value="1">Activo</option>
                                                                <option value="0">Desactivado</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="modal-footer justify-content-between">
                                                    <button id="btnCerrar" type="button" class="btn btn-secondary">
                                                        <i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="">
                                                            Guardar</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By
            <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>


<?php footerAdmin($data); ?>
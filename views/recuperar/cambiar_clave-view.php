
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Acceder</title>

   <!--  //VIDEO 12 : 02 MIN -->
    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= media(); ?>/vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= media(); ?>/vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= media(); ?>/vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/vendors/styles/style.css" />

</head>

    <body class="login-page">
        <div class="login-header box-shadow">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="brand-logo">
                    <a href="login">
                        <img src="<?= media(); ?>/vendors/images/deskapp-logo.svg" alt="" />
                    </a>
                </div>
                <div class="login-menu">
                    <ul>
                        <li><a href="login">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="<?= media(); ?>/vendors/images/forgot-password.png" alt="" />
                    </div>
                    <div class="col-md-6">
                        <div class="login-box bg-white box-shadow border-radius-10">
                            <div class="login-title">
                                <h2 class="text-center text-primary">Restablecer la contraseña</h2>
                            </div>
                            <h6 class="mb-20">Ingrese su nueva contraseña, confirme y envíe</h6>
                            <form id="formCambiarClav" name="formCambiarClav" action="">
                                <input type="hidden" id="idusuario" name="idusuario" value="<?= $data['idusuario']; ?>" required >
                                <input type="hidden" id="txtCorreo" name="txtCorreo" value="<?= $data['correo']; ?>" required >
                                <input type="hidden" id="txtToken" name="txtToken" value="<?= $data['token']; ?>" required >
                                <div class="input-group custom">
                                    <input id="txtclaveNuevo" name="txtclaveNuevo" type="password" class="form-control form-control-lg" placeholder="Nueva contraseña" />
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                    </div>
                                </div>
                                <div class="input-group custom">
                                    <input id="txtclaveNuevo2" name="txtclaveNuevo2" type="password" class="form-control form-control-lg"
                                        placeholder="Confirmar nueva contraseña" />
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="input-group mb-0">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" href="#">Reiniciar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- js -->
        <script> const base_url = "<?= base_url(); ?>";</script>
        <script src="<?= media(); ?>/vendors/scripts/core.js"></script>
        <script src="<?= media(); ?>/vendors/scripts/script.min.js"></script>
        <script src="<?= media(); ?>/vendors/scripts/process.js"></script>
        <script src="<?= media(); ?>/vendors/scripts/layout-settings.js"></script>
        <script src="<?= media(); ?>/src/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="<?= media(); ?>/admin-estilos/js/<?= $data['page_functions_js']; ?>"></script>

    </body>

</html>
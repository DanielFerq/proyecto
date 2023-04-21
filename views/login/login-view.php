<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Acceder</title>

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
<!--         <div id="divLoading" class="pre-loader">
          <div class="pre-loader-box">
            <div class="loader-logo">
              <img src="<?= media(); ?>/vendors/images/deskapp-logo.svg" alt="" />
          </div>
          <div class="loader-progress" id="progress_div">
              <div class="bar" id="bar1"></div>
          </div>
          <div class="percent" id="percent1">0%</div>
          <div class="loading-text">Cargando...</div>
      </div>
    </div>  -->
    
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="<?= media(); ?>/vendors/images/deskapp-logo.svg" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="register.html">Registrar</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?= media(); ?>/vendors/images/login-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Iniciar la sesión</h2>
                        </div>
                        <form id="formLogin" name="formLogin" action="" method="POST" autocomplete="off">
                            <div class="select-role">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn active">
                                        <input id="selectAdmin" type="radio" name="options" id="admin" />
                                        <div class="icon">
                                            <img src="<?= media(); ?>/vendors/images/briefcase.svg" class="svg"
                                                alt="" />
                                        </div>
                                        <span>Soy</span>Admin
                                    </label>
                                    <label class="btn">
                                        <input id="selectUser" type="radio" name="options" id="user" />
                                        <div class="icon">
                                            <img src="<?= media(); ?>/vendors/images/person.svg" class="svg" alt="" />
                                        </div>
                                        <span>Soy</span>Usuario
                                    </label>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input id="txtUsuario" name="txtUsuario" type="text"
                                    class="form-control form-control-lg" placeholder="Nombre de usuario" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input id="txtClave" name="txtClave" type="password"
                                    class="form-control form-control-lg" placeholder="**********" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                        <label class="custom-control-label" for="customCheck1"> Recuérdame</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password">
                                        <a href="recuperar">¿Olvidaste tu contraseña?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" id="btnIniciar"
                                            class="btn btn-primary btn-lg btn-block">Iniciar Sesión</button>
                                    </div>
                                    <br>
                                    <div class="input-group mb-0">
                                        <input type="button" id="btnRegistrar"
                                            class="btn btn-outline-primary btn-lg btn-block" href="#"
                                            value="Registrar cuenta" />
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
    <script>
    const base_url = "<?= base_url(); ?>";
    </script>
    <script src="<?= media(); ?>/vendors/scripts/core.js"></script>
    <script src="<?= media(); ?>/vendors/scripts/script.min.js"></script>
    <script src="<?= media(); ?>/vendors/scripts/process.js"></script>
    <script src="<?= media(); ?>/vendors/scripts/layout-settings.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/src/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= media(); ?>/admin-estilos/js/<?= $data['page_functions_js']; ?>"></script>

</body>

</html>
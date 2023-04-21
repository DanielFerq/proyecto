<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Modulo Usuario</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Configuración</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <!-- ================= INICIO CARD-TABS DE NAV ===================== -->
        <div class="card card-dark card-tabs">

          <!-- =================== TITULO DE NAV ======================= -->
          <ul class="nav nav-tabs card-header p-0 pt-1"  role="tablist">
            <li role="presentacion">
              <a href="#seccion1" class="nav-link active" aria-controls="seccion1" data-toggle="tab" role="tab">
                <i class="nav-icon fas fa-user-plus"></i> Nuevo usuario</a>
              </li>
              <li role="presentacion" >
                <a href="#seccion2" class="nav-link" aria-controls="seccion2" data-toggle="tab" role="tab">
                  <i class="nav-icon fas fa-users"></i> Lista de usuario</a>
                </li>
                <li role="presentacion" >
                  <a href="#seccion3" class="nav-link" aria-controls="seccion3" data-toggle="tab" role="tab">
                    <i class="nav-icon fas fa-search"></i> Buscar usuario</a>
                  </li>
                  <li role="presentacion" >
                    <a href="#seccion4" class="nav-link" aria-controls="seccion4" data-toggle="tab" role="tab">
                      <i class="nav-icon fas fa-users-slash"></i> Suspendido</a>
                    </li>
                  </ul>

                  <!-- ================== CONTENIDO DE NAV =================== -->
                  <div class="tab-content">

                    <!-- =========== SECCION 1 =========== -->
                    <div role="tabpanel" class="tab-pane fade show active" id="seccion1">
                      <div class="card-body" autocomplete="off">

                        <div class="callout callout-info">
                          <h5><i class="fas fa-info"></i> Nota:</h5>
                          Completar los campos solicitados Mínimo(<code>*</code>)
                        </div>

                        <form  id="form-registro" action="form" autocomplete="off">
                          <div class="card card-info">
                            <div class="card-header">
                              <h3 class="card-title">
                                <i class="nav-icon fas fa-info"> </i>
                                Información
                              </h3>
                            </div>
                            <div class="card-body">
                             <div class="form-group row">
                              <div class="col-6">
                                <label for="txtnom"><code>*</code>Nombres:</label>
                                <input type="text" id="txtnom" name="txtnom" class="form-control" maxlength="100"  autocomplete="off"/>
                              </div>
                              <div class="col-6">
                                <label for="txtapell"><code>*</code>Apellidos:</label>
                                <input type="text" id="txtapell" name="txtapell" class="form-control"  autocomplete="off"/>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-6">
                                <label for="txtcel">Celular:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                  </div>
                                  <input type="text" id="txtcel" name="txtcel" class="form-control"
                                  data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                                </div>
                              </div>
                              <div class="col-6">
                                <label for="txtdni">DNI:</label>
                                <input type="text" id="txtdni" name="txtdni" class="form-control" maxlength="7" />
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-6">
                                <label for="txtnac">Fecha de nacimiento:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                  </div>
                                  <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="yyyy/mm/dd" data-mask id="txtnac" name="txtnac" value="2000-01-01">
                                </div>
                              </div>
                              <div class="col-6">
                                <label for="cbogen">Genero:</label>
                                <select id="cbogen" name="cbogen" class="form-control">
                                  <option value="N">Seleccionar</option>
                                  <option value="M">Masculino</option>
                                  <option value="F">Femenino</option>
                                  <option value="O">Otros</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-6">
                                <label for="txtcorr">Correo:</label>
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                  </div>
                                  <input type="email"id="txtcorr" name="txtcorr" class="form-control">
                                </div>
                              </div>
                              <div class="col-6">
                                <label for="txtdir">Dirección:</label>
                                <input type="text" id="txtdir" name="txtdir" class="form-control" maxlength="100"  autocomplete="off"/>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card card-info">
                          <div class="card-header">
                            <h3 class="card-title">
                              <i class="nav-icon fas fa-barcode"> </i>
                              Tipo de usuario / Cuenta
                            </h3>
                          </div> 
                          <div class="card-body">
                            <div class="form-group row">
                              <div class="col-6">
                                <label for="cboniv"><code>*</code>Acceso:</label>
                                <select id="cboniv" name="cboniv" class="form-control">
                                  <option value="">Seleccionar</option>
                                </select>
                              </div>
                              <div class="col-6">
                                <label for="cboestado">Estado:</label>
                                <select id="cboestado" name="cboestado" class="form-control">
                                  <option value="1">Activo</option>
                                  <option value="0">Desactivado</option>
                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <div class="col-4">
                                <label for="txtid"><code>*</code>ID usuario:</label>
                                <input id="txtid" name="txtid" type="text" class="form-control" placeholder="Escriba el nombre de usuario">
                              </div>
                              <div class="col-4">
                                <label for="txtclav"><code>*</code>Contraseña:</label>
                                <input id="txtclav"name="txtclav" type="password" class="form-control" >
                              </div>
                              <div class="col-4">
                                <label for="txtclav2"><code>*</code>Repetir contraseña:</label>
                                <input id="txtclav2" name="txtclav2" type="password" class="form-control">
                              </div>
                            </div>
                          </div>
                        </div>

                  <!-- <div class="card card-dark">        
                          <div class="card-header">
                            <h3 class="card-title">
                              <i class="nav-icon fas fa-image"></i>
                              Foto de perfil
                            </h3>
                          </div>
                          <div class="card-body">
                            <div class="form-group">
                              <p>Tipos de archivos permitidos: JPG, JPEG, PNG Tamaño máximo 3MB.</p>
                              <p>Resolución recomendada 500px X 500px o superior manteniendo el aspecto cuadrado (1:1).</p>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="txtimg">
                                <label class="custom-file-label" for="txtimg">Elegir archivo</label>
                              </div>
                            </div>
                          </div>
                        </div> -->

                      </form>
                    </div>

                    <div class="card-footer">
                      <button id="btnGuardar" type="button" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                        Registrar
                      </button>
                      <button type="reset" id="btnCancelar" class="btn btn-default float-right" style="margin-right: 5px;"><i class="fas fa-window-close"></i>
                        Cancelar
                      </button>
                    </div>
                  </div>

                  <!-- =========== SECCION 1 =========== -->
                  <div role="tabpanel" class="tab-pane fade" id="seccion2">
                    <div id="tabla-usuario" class="card-body table-responsive">

                    </div>
                  </div>

                  <!-- =========== SECCION 3 =========== -->
                  <div role="tabpanel" class="tab-pane fade" id="seccion3">

                  </div>

                  <!-- =========== SECCION 4 =========== -->
                  <div role="tabpanel" class="tab-pane fade" id="seccion4">

                  </div>

                </div>
                <!-- ================ FIN CONTENIDO DE NAV ==================== -->

              </div>
            </div>
            <!-- ================= FIN CARD-TABS DE NAV ===================== -->
          </div>
        </div>


        <!-- ================= MODAL DE VISTA ===================== -->
        <div class="modal fade" id="ModalPerfil" role="dialog">
          <div class="modal-dialog">
            <div class="d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header">
                  Información del perfil
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="card-body">

                 <div class="row">

                  <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">

                    <!-- <h2 class="lead"><b ></b></h2> -->

                    <p class="text-muted text-sm"><b>Acerca de:</b></p>
                    <div class="form-group">
                      <div class="col-6">
                        <label for="">Dirección</label>
                        <input type="text" id="txtnomshow">
                      </div>
                      <div class="col-6">
                        
                      </div>
                    </div>
                    

                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small">
                        <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                        <b>Dirección:</b>
                        <label for="" id=""></label>
                      </li>

                      <p class="small">Alto laran</p>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><b>Teléfono:</b></li>
                      <p class="small">Alto laran</p>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><b>Correo electrónico:</b></li>
                      <p class="small">Alto laran</p>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><b>Fecha de nacimiento:</b></li>
                      <p class="small">Alto laran</p>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><b>Genero:</b></li>
                      <p class="small">Alto laran</p>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><b>DNI:</b></li>
                      <p class="small">Alto la</p>
                    </ul>

                  </div>

                  <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">

                    <div>
                      
                    </div>
                    <img src="../image/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                    <br>
                    <li class="small"><b>Tipo de usuario:</b></li>
                    <p class="small">Cliente</p>

                  </div>

                </div> 

<!--               <div class="row col-md-12">
                <div class="col-md-6">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                      src="../../dist/img/user4-128x128.jpg"
                      alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">Nina Mcintire</h3>

                    <p class="text-muted text-center">Software Engineer</p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Followers</b> <a class="float-right">1,322</a>
                      </li>
                      <li class="list-group-item">
                        <b>Following</b> <a class="float-right">543</a>
                      </li>
                      <li class="list-group-item">
                        <b>Friends</b> <a class="float-right">13,287</a>
                      </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                  </div>
                </div>

                <div class="col-md-6">
                  <dt class="col-sm-4">Description lists</dt>s
                  <dd class="col-sm-8">A description list is perfect for defining terms.</dd>
                  <dt class="col-sm-4">Euismod</dt>
                  <dd class="col-sm-8">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                  <dd class="col-sm-8 offset-sm-4">Donec id elit non mi porta gravida at eget metus.</dd>
                  <dt class="col-sm-4">Malesuada porta</dt>
                  <dd class="col-sm-8">Etiam porta sem malesuada magna mollis euismod.</dd>
                  <dt class="col-sm-4">Felis euismod semper eget lacinia</dt>
                  <dd class="col-sm-8">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
                    sit amet risus.
                  </dd>
                  
                </div>
              </div> -->

            </div>

            <div class="card-footer">
              <div class="text-right">
                <a href="#" class="btn btn-sm btn-default"><i class="fas fa-comments"></i>Salir</a>
                <a href="#" class="btn btn-sm bg-teal"><i class="fas fa-comments"></i>Reiniciar contraseña</a>
                <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-user"></i>Cambiar foto</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </section>
</div>



<script>
  $(document).ready(function(){

    var datosNuevos = true;
    var idusuario = "";

    function ReiniciarFormulario(){
      $("#form-registro")[0].reset();
      $("#btnGuardar").html("Guardar");
      idusuario ="";
    }

    var espanol = {
      "decimal": "",
      "emptyTable": "No hay información",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
      "infoFiltered": "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ Entradas",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
      }

    };

      //LISTAR PERMISOS POR DEFECTO
      $.ajax({
        url:'../controllers/permiso.controller.php',
        data:'operacion=cbolistar',
        type:'GET',
        cache: false,
        contentType: false
      })
      .done(function(res){
        $("#cboniv").html(res);
      });
      //--------------------------------------

      //---- BOTON GUARDAR --------
      $("#btnGuardar").click(function(){
        //DECLARAMOS VARIABLE Y OBTENEMOS SU VALOR()
        var nombre    = $("#txtnom").val();
        var apellido  = $("#txtapell").val();
        var celular   = $("#txtcel").val();
        var dni       = $("#txtdni").val();
        var fechanac  = $("#txtnac").val();
        var genero    = $("#cbogen").val();
        var permisos  = $("#cboniv").val();
        var correo    = $("#txtcorr").val();
        var direccion = $("#txtdir").val();
        var estado    = $("#cboestado").val();
        var nombreusuario = $("#txtid").val();
        var clave1    = $("#txtclav").val();
        var clave2    = $("#txtclav2").val();

      //CREAMOS UN ALERTA DE CONTINUAR
      swal.fire({
        title:'¿Desea continuar?',
        text:'¡Sistema de Tienda!',
        icon:'question',
        showCancelButton:true,
        showConfirmButton:true,
        confirmButtonColor:'#00CE68',
        cancelButtonColor:'#9c9c9c',
        confirmButtonText:'Aceptar',
        cancelButtonText:'Cancelar'
      }).then((result) =>{
        if(result.isConfirmed){
          //SI LOS CAMPOS ESTA VACÍO
          if(nombre.length == 0 || apellido.length == 0 || nombreusuario.length == 0 || clave1.length==0  || clave2.length==0 || permisos.length == 0){
            swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Complete los campos solicitados mínimo (*)'
            });
            $("#txtnom").select();
          }else{
            //SI LA CONTRASEÑA NO COINCIDEN
            if(clave1 != clave2){
              swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La contraseña deben coincidir'
              });
              $("#txtclav2").select();
            }else{

              if(datosNuevos){
                var datos ={
                  'operacion' : 'registrar',
                  'idpermiso' : permisos,
                  'nombreusuario' : nombreusuario,
                  'clave' : clave2,
                  'nombres' : nombre,
                  'apellidos' : apellido,
                  'dni' : dni,
                  'fechanac' : fechanac,
                  'celular' : celular,
                  'genero' : genero,
                  'correo' : correo,
                  'estado' : estado
                };
              }else{
                var datos ={
                  'operacion' : 'modificar',
                  'idusuario' : idusuario,
                  'idpermiso' : permisos,
                  'nombreusuario' : nombreusuario,
                  'clave' : clave2,
                  'nombres' : nombre,
                  'apellidos' : apellido,
                  'dni' : dni,
                  'fechanac' : fechanac,
                  'celular' : celular,
                  'genero' : genero,
                  'correo' : correo,
                  'estado' : estado
                };
              }
              $.ajax({
                url: '../controllers/usuario.controller.php',
                type: 'GET',
                datatype: 'html',
                data: datos,
                cache: false,
                contentType: false
              }).done(function(){
                swal.fire({
                  icon: 'success',
                  title: 'Se guardó correctamente',
                  timer: 1500
                });
                ReiniciarFormulario();
                ListarCliente();;
                datosNuevos = true;
              });
            }

          }

        }
      });

    });


      $("#tabla-usuario").on("click","a[data-operacion=consultar]", function(){
        var id = $(this).attr("data-id");
        var registro = new Array();
      //datosNuevos = false;

      $.ajax({
        url: '../controllers/usuario.controller.php',
        type: 'GET',
        data: 'operacion=info&idusuario='+ id,
      }).done(function(e){
        registro = JSON.parse(e);
        //idclasificacion = registro.idclasificacion;
        $("#txtnomshow").val(registro.idusuario);
        //alert(e);
      });
    });

    //MODIFICAR USUARIO
    $("#tabla-usuario").on("click","a[data-operacion=modificar]",function(){
      var id = $(this).attr("data-id");
      var registro = new Array();
      datosNuevos = false;

      $.ajax({
        url: '../controllers/usuario.controller.php',
        type: 'GET',
        data: 'operacion=consultar&idusuario='+ id,
      }).done(function(e){
        registro = JSON.parse(e);
        idusuario = registro.idusuario;
        $("#txtnom").val(registro.nombres);
        $("#txtapell").val(registro.apellidos);
        $("#txtcel").val(registro.celular);
        $("#txtdni").val(registro.dni);
        $("#txtnac").val(registro.fechanac);
        $("#cbogen").val(registro.genero);
        $("#cboniv").val(registro.idpermiso);
        $("#txtcorr").val(registro.correo);
       // $("#txtdir").val(registro.);
       $("#cboestado").val(registro.estado);
       $("#txtid").val(registro.nombreusuario);
       $("#txtclav").val(registro.clave);
       $("#txtclav2").val(registro.clave);
       $("#btnGuardar").html("Actualizar");

        //SELECCIONAR EL SECTION
        $('.nav-tabs a[href="#seccion1"]').tab('show');
      });

    });


    //LISTAR CLIENTE
    function ListarCliente(){
      $.ajax({
        url: '../controllers/usuario.controller.php',
        data: 'operacion=listar',
        type: 'GET',
        success: function(e){
          $("#tabla-usuario").html(e);
          CargarDataTable();
        }
      });
    }

    //CARGAR TABLA
    function CargarDataTable(){
      $("#example1").DataTable({
        "responsive": true, 
        "lengthChange": true, 
        "autoWidth": false, 
        "info": true,
        "ordering": true,
        "paging": true,
        "language": espanol,
        "buttons": [/*"copy", "csv", */"excel", "pdf"/*, "print", "colvis"*/]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }

    ListarCliente();

  });
</script>

<script>
  $(function () {
    $('.select2').select2()
  });
</script>
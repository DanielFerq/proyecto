<div class="content-wrapper">
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Modulo de Categoria</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Cátalago</a></li>
          <li class="breadcrumb-item active">Categoria</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

 <!-- ./row -->
 <div class="row">
  <div class ="col-md-12">
    <div class="card card-dark card-tabs" role="tabpanel">

      <!-- ====== TITULO DE NAV ======= -->

      <ul class="nav nav-tabs card-header p-0 pt-1"  role="tablist">
        <li role="presentacion">
          <a href="#seccion1" class="nav-link active" aria-controls="seccion1" data-toggle="tab" role="tab">
          <i class="nav-icon fas fa-user-plus"></i> Nuevo Categoria</a>
        </li>
        <li role="presentacion" >
          <a href="#seccion2" class="nav-link" aria-controls="seccion2" data-toggle="tab" role="tab">
          <i class="nav-icon fas fa-users"></i> Lista de Categoria</a>
          </li>
      </ul>

      <!-- ====== CONTENIDO DE NAV ======= -->
      <div class="tab-content">
        <!-- =========== SECCION 1 =========== -->
        <div role="tabpanel" class="tab-pane fade show active" id="seccion1">
          <div class="card-body">

          <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Nota:</h5>
               Para agregar más clasificaciones, Click en <span class="badge bg-primary"> Cátalagos </span> luego <span class="badge badge-success"> Clasificación </span>.
          </div>
            <div class="card">
              <form id="form-registro" action="form" autocomplete="off">
                <div class="card-body row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="cboClas">Clasificación:</label>
                      <select id="cboClas" name="cboClas" class="form-control">
                        <option value="">Seleccionar</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="cboEstado">Estado:</label>
                      <select id="cboEstado" name="cboEstado" class="form-control">
                        <option value="1">Activo</option>
                        <option value="0">Desactivado</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                   <div class="form-group">
                    <label for="txtCat">Categoria:</label>
                    <input type="text" id="txtCat" name="txtCat" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label for="txtDesc">Descripción:</label>
                    <input type="text" id="txtDesc" name="txtDesc" class="form-control" />
                  </div>
                </div>
              </form>
            </div>

              <div class="card-footer">
              <button id="btnGuardar" type="button" class="btn btn-primary float-right"><i class="fas fa-save"></i>
                Guardar
              </button>
              <button type="button" id="btnCancelar" class="btn btn-default float-right" style="margin-right: 5px;"><i class="fas fa-window-close"></i>
                Cancelar
              </button>
            </div>
            </div>
          </div>
        </div>

        <!-- =========== SECCION 1 =========== -->
        <div role="tabpanel" class="tab-pane fade" id="seccion2">
          <div id="tabla-categoria" class="card-body table-responsive">

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

 /*TRUE = GUARDAR FALSE = ACTUALIZAR*/
    var datosNuevos = true;
    var idcategoria ="";

   function ReiniciarFormulario(){
    $("#form-registro")[0].reset();
    $("#btnGuardar").html("Guardar");
    idcategoria ="";
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

    $.ajax({
      url:'../controllers/clasificacion.controller.php',
      data:'operacion=cbolistar',
      type:'GET',
      cache: false,
      contentType: false
    })
    .done(function(res){
      $("#cboClas").html(res);
    });


    $("#btnGuardar").click(function(){
        var categoria = $("#txtCat").val();
        var descripcion = $("#txtDesc").val();
        var clasificacion = $("#cboClas").val();
        var estado = $("#cboEstado").val();
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
            if(categoria == "" || descripcion == "" || clasificacion == "" || estado == ""){
              swal.fire({
                icon: 'error',
                title: 'Complete los campos solicitados'
              });
              $("#txtCat").focus();
            }else{

              if(datosNuevos){
                var datos ={
                  'operacion' : 'registrar',
                  'idclasificacion' : clasificacion,
                  'categoria' : categoria,
                  'descripcion' : descripcion,
                  'estado' : estado
                };
              }else{
                var datos ={
                  'operacion' : 'modificar',
                  'idcategoria' : idcategoria,
                  'idclasificacion' : clasificacion,
                  'categoria' : categoria,
                  'descripcion' : descripcion,
                  'estado' : estado
                };
              }

              $.ajax({
                url: '../controllers/categoria.controller.php',
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
                ListarCategoria();
                datosNuevos = true;
              });
            }
          }
        });

      });

    $("#tabla-categoria").on("click","a[data-operacion=modificar]", function(){
      var id = $(this).attr("data-id");
      var registro = new Array();
      datosNuevos = false;

      $.ajax({
        url: '../controllers/categoria.controller.php',
        type: 'GET',
        data: 'operacion=obtener&idcategoria='+ id,
      }).done(function(e){
        //alert(e);
        registro = JSON.parse(e);
        idcategoria = registro.idcategoria;
        $("#cboClas").val(registro.idclasificacion);
        $("#txtCat").val(registro.categoria);
        $("#txtDesc").val(registro.descripcion);
        $("#cboEstado").val(registro.estado);
        $("#btnGuardar").html("Actualizar");
            /*Seleccionar primera pestaña*/
        $('.nav-tabs a[href="#seccion1"]').tab('show');
      });
     });

    $("#tabla-categoria").on("click", "a[data-operacion=eliminar]", function(){
      var id = $(this).attr("data-id");

      swal.fire({
        title: '¿Seguro de continuar?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#00CE68',
        cancelButtonColor: '#9c9c9c',
        confirmButtonText: '¡Sí, bórralo!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if(result.isConfirmed){

          $.ajax({
            url: '../controllers/categoria.controller.php',
            data: 'operacion=eliminar&idcategoria=' + id,
            type: 'GET',
          }).done(function(e){
            ListarCategoria();
            ReiniciarFormulario();
          });

          swal.fire({
            icon: 'success',
            title: 'Se ha eliminado correctamente',
            timer: 1000
          });

        }
      })

    });

    function ListarCategoria(){
      $.ajax({
        url: '../controllers/categoria.controller.php',
        data: 'operacion=listar',
        type: 'GET',
        success: function(e){
          $("#tabla-categoria").html(e);
          CargarDataTable();
        }
      });
    }


    function CargarDataTable(){
      $("#example1").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false, 
        "info": true,
        "ordering": true,
        "paging": true,
        "language": espanol,
        /*  "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]*/
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }
    $("#btnCancelar").click(function (){
      datosNuevos = true;
      ReiniciarFormulario();
      ListarCategoria();
    });

    ListarCategoria();

  });
</script>


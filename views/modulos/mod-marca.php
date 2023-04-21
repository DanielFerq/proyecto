<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Modulo de Marca</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Cátalago</a></li>
            <li class="breadcrumb-item active">Marca</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="card card-dark">

      <div class="card-header">
        <h3 class="card-title">
          <i class="nav-icon fas fa-box"></i>
          Información de Marca
        </h3>
      </div>

      <div class="card-body">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalNuevo">
          <i class="nav-icon fa fa-plus"></i> Nuevo
        </button>
        <div id="tabla-marca" class="table-responsive">

        </div>
      </div>

      <!-- MODAL AGREGAR MARCA -->
      <div class="modal fade" id="ModalNuevo" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 id="ModalTitulo" class="modal-title">Registro de Marca</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="form" action="formMarc" autocomplete="off">
                <div class="form-group">
                  <label for="txtnom">Nombre:</label>
                  <input type="text" class="form-control" id="txtnom" name="txtnom" placeholder="Escriba la marca">
                </div>
                <div class="form-group">
                  <label for="cboestado">Estado:</label>
                  <select id="cboestado" name="cboestado" class="form-control">
                    <option value="1">Activo</option>
                    <option value="0">Desactivado</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button id="btnCancelar" type="button" class="btn btn-default" data-dismiss="modal">
                <i class="fas fa-times"></i> Cancelar
              </button>
              <button type="button" class="btn btn-primary" id="btnGuardar">
                <i class="fas fa-save"></i> Guardar
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

    </div>
  </section>

</div>



  <script>
   $(document).ready(function(){

    var datosNuevos = true;
    var idmarca = "";
    $("#txtnom").focus();
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

    function ReiniciarFormulario(){
      $("#formMarc")[0].reset();
      $("#txtnom").focus();
      $("#btnGuardar").html("Guardar");
      $("#ModalTitulo").html("Registro de clasificación")
      idmarca = "";
    }

    $("#btnGuardar").click(function(){
        //var idclasificacion = "";
        var nombremarca = $("#txtnom").val();
        var estado = $("#cboestado").val();
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
            if(nombremarca == " " || estado == " "){
              swal.fire({
                icon: 'error',
                title: 'Complete los campos solicitados'
              });
              $("#txtnom").focus();
            }else{

              if(datosNuevos){
                var datos ={
                  'operacion' : 'registrar',
                  'nombremarca' : nombremarca,
                  'estado' : estado
                };
              }else{
                var datos ={
                  'operacion' : 'modificar',
                  'idmarca' : idmarca,
                  'nombremarca' : nombremarca,
                  'estado' : estado
                };
              }

              $.ajax({
                url: '../controllers/marca.controller.php',
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
                ListarMarca();
                $("#txtnom").val(null);
                datosNuevos = true;
                ReiniciarFormulario();
              });
            }
          }
        });

      });

    $("#tabla-marca").on("click","a[data-operacion=modificar]", function(){
      var id = $(this).attr("data-id");
      var registro = new Array();
      datosNuevos = false;

      $.ajax({
        url: '../controllers/marca.controller.php',
        type: 'GET',
        data: 'operacion=obtener&idmarca='+ id,
      }).done(function(e){
        registro = JSON.parse(e);
        idmarca = registro.idmarca;
        $("#txtnom").val(registro.nombremarca);
        $("#cboestado").val(registro.estado);
        $("#btnGuardar").html("Actualizar");
        $("#ModalTitulo").html("Modificar marca")
        //ReiniciarFormulario();
      });
    });

    $("#tabla-marca").on("click", "a[data-operacion=eliminar]", function(){
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
            url: '../controllers/marca.controller.php',
            data: 'operacion=eliminar&idmarca=' + id,
            type: 'GET',
          }).done(function(e){
            ListarMarca();
          });

          swal.fire({
            icon: 'success',
            title: 'Se ha eliminado correctamente',
            timer: 1000
          });

        }
      })

    });

    function ListarMarca(){
      $.ajax({
        url: '../controllers/marca.controller.php',
        data: 'operacion=listar',
        type: 'GET',
        success: function(e){
          $("#tabla-marca").html(e);
              CargarDataTable();
        }
      });
    }

    $("#btnCancelar").click(function(){
      ReiniciarFormulario();
    });

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
    ListarMarca();
  });

</script>
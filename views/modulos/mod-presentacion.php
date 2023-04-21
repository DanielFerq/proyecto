
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Modulo de Presentación</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item"><a href="#">Configuración</a></li>
          <li class="breadcrumb-item active">Presentación</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="card card-dark">
    <div class="card-header">
      <h3 class="card-title">
        <i class="nav-icon fas fa-box"></i>
        Información de Presentación
      </h3>
    </div>

    <div class="card-body">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalNuevo">
        <i class="nav-icon fa fa-plus"></i> Nuevo
      </button>
      <div id="tabla-clasificacion" class="table-responsive ">

      </div>  
    </div>

    <!-- MODAL AGREGAR -->
    <div class="modal fade" id="ModalNuevo" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="ModalTitulo" class="modal-title">Formulario de registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="form"  id="form" action="formclas" autocomplete="off">
              <div class="form-group">
                <label for="txtnom">Nombre:</label>
                <input type="text" class="form-control" id="txtnom" name="txtnom" placeholder="Escriba la clasificación">
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
      </div>
    </div>
  </div>

</section>

<?php require_once"../views/footerJS.php" ?>

<script>

 $(document).ready(function(){

  var datosNuevos = true;
  var idclasificacion = "";
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
    $("#form")[0].reset();
    $("#txtnom").focus();
    $("#btnGuardar").html("Guardar");
    $("#ModalTitulo").html("Registro de clasificación")
    idclasificacion = "";
  }

  $("#btnGuardar").click(function(){
    var clasificacion = $("#txtnom").val();
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
        if(clasificacion == "" || estado == ""){
          swal.fire({
            icon: 'error',
            title: 'Complete los campos solicitados'
          });
          $("#txtnom").focus();
        }else{

          if(datosNuevos){
            var datos ={
              'operacion' : 'registrar',
              'clasificacion' : clasificacion,
              'estado' : estado
            };
          }else{
            var datos ={
              'operacion' : 'modificar',
              'idclasificacion' : idclasificacion,
              'clasificacion' : clasificacion,
              'estado' : estado
            };
          }

          $.ajax({
            url: '../controllers/clasificacion.controller.php',
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
            ListarClasificacion();
            $("#txtnom").val(null);
            datosNuevos = true;
            ReiniciarFormulario();
          });
        }
      }
    });

  });

  $("#tabla-clasificacion").on("click","a[data-operacion=modificar]", function(){
    var id = $(this).attr("data-id");
    var registro = new Array();
    datosNuevos = false;

    $.ajax({
      url: '../controllers/clasificacion.controller.php',
      type: 'GET',
      data: 'operacion=obtener&idclasificacion='+ id,
    }).done(function(e){
      registro = JSON.parse(e);
      idclasificacion = registro.idclasificacion;
      $("#txtnom").val(registro.clasificacion);
      $("#cboestado").val(registro.estado);
      $("#btnGuardar").html("Actualizar");
      $("#ModalTitulo").html("Modificar clasificacion")
        //ReiniciarFormulario();
      });
  });

  $("#tabla-clasificacion").on("click", "a[data-operacion=eliminar]", function(){
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
          url: '../controllers/clasificacion.controller.php',
          data: 'operacion=eliminar&idclasificacion=' + id,
          type: 'GET',
        }).done(function(e){
          ListarClasificacion();
        });

        swal.fire({
          icon: 'success',
          title: 'Se ha eliminado correctamente',
          timer: 1000
        });

      }
    })

  });

  function ListarClasificacion(){
    $.ajax({
      url: '../controllers/clasificacion.controller.php',
      data: 'operacion=listar',
      type: 'GET',
      success: function(e){
        $("#tabla-clasificacion").html(e);
        CargarDataTable();
        ReiniciarFormulario();
      }
    });
  }

  $("#btnCancelar").click(function(){
    ReiniciarFormulario();
    datosNuevos = true;
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
  ListarClasificacion();
});

</script>

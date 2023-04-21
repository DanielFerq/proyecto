  //VIDEO 17 MIN: 0:38
  var tableRoles;

  document.addEventListener('DOMContentLoaded', function(){

    tableRoles = $("#tableRoles").dataTable({
      "aProcessing":true,
      "aServerSide":true,
      "language": {
        "url": base_url + "/assets/admin-estilos/js/espanol.json"
      },
      "ajax":{
        "url": " "+base_url+"/rol/getRoles",
        "dataSrc":""
      },
      "columns":[
        {"data":"idrol"},
        {"data":"nombrerol"},
        {"data":"descriprol"},
        {"data":"estado"},
        {"data":"opcion"}
        ],
        'dom':  '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"<"dt-buttons btn-group flex-wrap"B>>'+
                '<"col-sm-12 col-md-4"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        'buttons': [
            {
              "extend": "copy",
              "text": "<i class='icon-copy fa fa-copy' aria-hidden='true'></i>",
              "titleAttr":"Copiar",
              "className": "btn btn-secondary btn-sm"
          },{
              "extend": "excel",
              "text": "<i class='icon-copy fa fa-file-excel-o' aria-hidden='true'></i>",
              "titleAttr":"Exportar a Excel",
              "className": "btn btn-success btn-sm"
          },{
              "extend": "pdf",
              "text": "<i class='icon-copy fa fa-file-pdf-o' aria-hidden='true'></i>",
              "titleAttr":"Exportar a PDF",
              "className": "btn btn-danger btn-sm"
          }/*,{
              "extend": "csv",
              "text": "<i class='icon-copy fa fa-file-text-o' aria-hidden='true'></i>",
              "titleAttr":"Exportar a CSV",
              "className": "btn btn-info btn-sm"
            }*/
      ],
      "responsive": true,
      "bDestroy": true,
      "iDisplayLength": 10,
      "order":[[0,"desc"]]  
    });

  // LLAMAMOS AL ID DEL FORMULARIO REGISTRO ROL - MODAL 
  var formRol = document.querySelector("#formRol");


  //ASIGNAMOS LA FUNCION ON SUBMIT
  formRol.onsubmit = function(e){

    e.preventDefault();

      //OBTENEMOS LOS DATOS INGRESADO MEDIANTE VALUE
      var strIdRol = document.querySelector('#txtidrol').value;
      var strNombre = document.querySelector('#txtnom').value;
      var strDescripcion = document.querySelector('#txtdesc').value;
      var intEstado = document.querySelector('#cboestado').value;

      //VALIDAMOS QUE LOS DATOS INGRESEN CORRECTAMENTE
      if(strNombre == '' || strDescripcion == '' || intEstado == ''){
        Swal.fire("Atención", "Todos los campos son obligatorios.","error");
        return false;
      }
      //DETECTAR EN EL NAVEGOR 
      var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      var ajaxUrl = base_url+'/rol/setRol';

      //
      var formData = new FormData(formRol);

      //ENVIO DE DATOS MEDIANTE AJAX
      request.open("POST",ajaxUrl,true);
      request.send(formData);
      request.onreadystatechange = function(){
        console.log(request);

        if(request.readyState == 4 && request.status == 200){
            //console.log(request.responseText);

          var objData = JSON.parse(request.responseText);

             if(objData.resultado){
                $('#modalFormRol').modal('hide');
                formRol.reset();
                Swal.fire("Roles de usuario", objData.msg,"success");

                //ACTUALIZAR LA TABLA ROL
                tableRoles.api().ajax.reload(function(){
                  fntEditarRol();
                  fntEliminarRol();
                  fntPermisoRol();
                });

            }else{
              Swal.fire("Error", objData.msg,"error");
            }

        }

      }

    }

  });

   $("#tableRoles").DataTable();


     $("#btnNuevoRol").click(function () {
        //CAMBIAMOS POR DEFECTO AL INICIO
      document.querySelector('#txtidrol').value = "";
      document.querySelector('.modal-header').classList.replace("bg-info", "bg-dark");
        //document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
      document.querySelector('#btnText').innerHTML = " Guardar";
      document.querySelector('#ModalTitulo').innerHTML = "Registro de Rol";
      document.querySelector("#formRol").reset();
      $('#modalFormRol').modal('show');
    });

    // SE VE AGREGAR EL EVENTO CUANDO SE CARGUE TODO LOS ELEMENTOS
    window.addEventListener('load', function(){
      //console.log("Todos los recursos terminaron de cargar!");
      fntEditarRol();
      fntEliminarRol();
      fntPermisoRol();

    },false);


    function fntEditarRol(){
      $("#tableRoles").on("click", "button[data-operacion=editar]", function(){
          
          document.querySelector('#ModalTitulo').innerHTML = "Actualizar Rol";
          //document.querySelector('.modal-header').classList.replace("bg-", "bg-info");
          document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
          document.querySelector('#btnText').innerHTML =" Actualizar";
          
          //obtenemos un valor del button Editar
          var strIdRol = this.getAttribute("data-id");
          
          var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
          var ajaxUrl = base_url+'/rol/getRol/'+strIdRol;
          request.open("GET",ajaxUrl,true);
          request.send();
          
          request.onreadystatechange = function(){
            
            if(request.readyState == 4 && request.status == 200){
              //console.log(request.responseText);
              var objData = JSON.parse(request.responseText);
              
              if(objData.resultado){
                
                document.querySelector("#txtidrol").value = objData.data.idrol;
                document.querySelector("#txtnom").value = objData.data.nombrerol;
                document.querySelector("#txtdesc").value = objData.data.descriprol;
                document.querySelector("#cboestado").value = objData.data.estado;
                $('#cboestado').selectpicker('render');
                
                $('#modalFormRol').modal('show');
                
              }else{
               Swal.fire("Error", objData.msg,"error");
             }
             
           }
         }    
         
       });
    }

    function fntEliminarRol(){
      $("#tableRoles").on("click", "button[data-operacion=eliminar]", function(){

         var strIdRol = this.getAttribute("data-id");
         //alert(strIdRol);

         Swal.fire({
          title: '¿Desea continuar?',
          text: "¡No podrás revertir esto!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#dc3545',
          cancelButtonColor: '#9c9c9c',
          confirmButtonText: '¡Sí, bórralo!',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if(result.isConfirmed){

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/rol/delRol/';
            var strData = "idrol="+strIdRol;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            
            request.onreadystatechange = function(){
              if(request.readyState == 4 && request.status == 200){

                var objData = JSON.parse(request.responseText);

                if(objData.resultado){

                  Swal.fire("Atención!", objData.msg , "success");

                  tableRoles.api().ajax.reload(function(){
                    fntEditarRol();
                    fntEliminarRol();
                    fntPermisoRol();
                  });

                }else{
                  Swal.fire("Atención!", objData.msg , "error");
                }

              }
            }

          }
        });

      });
    }

    function fntPermisoRol(){
     $("#tableRoles").on("click", "button[data-operacion=permiso]", function(){

       var strIdRol = this.getAttribute("data-id");
       var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
       var ajaxUrl = base_url+'/permiso/getPermisoRol/'+strIdRol;
       request.open("GET",ajaxUrl,true);
       request.send();

       request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
                //console.log(request.responseText);
          document.querySelector('#contentAjax').innerHTML = request.responseText;
          
          //Mostrar Js de Switch a todos
          var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            elems.forEach(function(html) {
                var switchery = new Switchery(html); 
            });

          $('#modalPermiso').modal('show');
          document.querySelector('#formPermiso').addEventListener('submit',fntGuardarPermiso,false);
        }
      }

    });
   }

    function fntGuardarPermiso(evnet){
      evnet.preventDefault();
      var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      var ajaxUrl = base_url+'/permiso/setPermiso'; 
      var formElement = document.querySelector("#formPermiso");
      var formData = new FormData(formElement);
      request.open("POST",ajaxUrl,true);
      request.send(formData);

      request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
          var objData = JSON.parse(request.responseText);
          
          if(objData.resultado){
            Swal.fire("Permisos de usuario", objData.msg ,"success");
          }else{
            Swal.fire("Error", objData.msg , "error");
          }

        }
      }
    
  }
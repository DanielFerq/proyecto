let tableUsuarios;
document.addEventListener('DOMContentLoaded', function () {

    tableUsuarios = $("#tableUsuarios").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": base_url + "/assets/admin-estilos/js/espanol.json"
        },
        "ajax": {
            "url": " " + base_url + "/usuario/getUsuarios",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idusuario" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "nombreusuario" },
            { "data": "correo" },
            { "data": "celular" },
            { "data": "nombrerol" },
            { "data": "estado" },
            { "data": "opcion" }
            ],
        'dom':  '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"<"dt-buttons btn-group  btn-sm flex-wrap"B>>'+
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
          },{
              "extend": "csv",
              "text": "<i class='icon-copy bi bi-filetype-csv' aria-hidden='true'></i>",
              "titleAttr":"Exportar a CSV",
              "className": "btn btn-info btn-sm"
            }
      ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

    $("#txtfoto").on('change',function () {

        let foto = document.querySelector("#txtfoto");
        let uploadFoto = document.querySelector("#txtfoto").value;
        let fileimg = document.querySelector("#txtfoto").files;
        let nav = window.URL || window.webkitURL;
        let contactAlert = document.querySelector('#form_alert');
        if(uploadFoto !=''){
            let type = fileimg[0].type;
            let name = fileimg[0].name;
            if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                if(document.querySelector('#img')){
                    document.querySelector('#img').remove();
                }
                document.querySelector('#xfoto').classList.add("notblock");
               
                foto.value="";
                return false;
            }else{  
                contactAlert.innerHTML='';
                if(document.querySelector('#img')){
                    document.querySelector('#img').remove();
                }
            
                document.querySelector('#xfoto').classList.remove("notblock");
                let objeto_url = nav.createObjectURL(this.files[0]);
                document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
            }
        }else{
            Swal.fire("Atención","No selecciono foto","error");
            if(document.querySelector('#img')){
                document.querySelector('#img').remove();
            }
        }
    });

$("#xfoto").click(function () {
    document.querySelector("#foto_remove").value= 1;
    removePhoto();
});


    let formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function (e) {
        e.preventDefault();

        let idusuario = document.querySelector('#txtidusuario').value;
        let nombre = document.querySelector('#txtnom').value;
        let apellido = document.querySelector('#txtapell').value;
        let correo = document.querySelector('#txtcorreo').value;
        let fechanac = document.querySelector('#txtfechanac').value;
        let celular = document.querySelector('#txtcel').value;
        let dni = document.querySelector('#txtdni').value;
        let rol = document.querySelector('#cborol').value;
        let estado = document.querySelector('#cboestado').value;
        let usuario = document.querySelector('#txtuser').value;
        let clave1 = document.querySelector('#txtclave').value;
        let clave2 = document.querySelector('#txtclave2').value;

        if (usuario == '' || rol == '' || estado == '' || nombre == '' || apellido == '') {
            Swal.fire("Atención", "Todos los campos son obligatorios(*)", "error");
            return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('form-control-danger')) { 
                Swal.fire("Atención", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        } 

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/usuario/setUsuario';
        let formData = new FormData(formUsuario);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                //console.log(request.responseText);
                let objData = JSON.parse(request.responseText);
                if (objData.resultado) {
                    $('#modalFormUsuario').modal('hide');
                    formUsuario.reset();
                    Swal.fire("Usuarios", objData.msg, "success");
                    removePhoto();
                    tableUsuarios.api().ajax.reload();
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }
        }

    }


}, false);


window.addEventListener('load', function () {
    fntRolesUsuario();
    fntViewUsuario();
    fntEditarUsuario();
    fntEliminarUsuario();
}, false);


function fntRolesUsuario() {
    let ajaxUrl = base_url + '/rol/getSeleccionarRoles';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#cborol').innerHTML = request.responseText;
            //Por defecto cliente
            //document.querySelector('#cborol').value = "RL00000005";

            $('#cborol').selectpicker('render');
        }
    }

}



function fntViewUsuario() {

    $("#tableUsuarios").on("click", "button[data-operacion=ver]", function () {

        let idusuario = this.getAttribute("data-id");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/usuario/getIdUsuario/' + idusuario;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);

                if (objData.resultado) {

                    let estadoUsuario = objData.data.estado == 1 ?
                        '<span class="badge badge-success">Activo</span>' :
                        '<span class="badge badge-danger">Desactivado</span>';

                    document.querySelector("#viewName").innerHTML = objData.data.datos;
                    document.querySelector("#viewRol").innerHTML = objData.data.nombrerol;
                    document.querySelector("#viewUser").innerHTML = objData.data.nombreusuario;
                    document.querySelector("#viewCorreo").innerHTML = objData.data.correo;
                    document.querySelector("#viewDNI").innerHTML = objData.data.dni;
                    document.querySelector("#viewCel").innerHTML = objData.data.celular;
                    document.querySelector("#viewImagen").innerHTML = '<img src="'+objData.data.url_imagen+'" alt="" class="avatar-photo renderizar" />';
                    document.querySelector("#viewGenero").innerHTML = objData.data.genero;
                    document.querySelector("#ViewFech").innerHTML = objData.data.fechanac;
                    document.querySelector("#viewEstado").innerHTML = estadoUsuario;
                    document.querySelector("#viewUltim").innerHTML = objData.data.ultimoacceso;
                    document.querySelector("#viewRegis").innerHTML = objData.data.fecharegistro;
                    $('#modalViewUsuario').modal('show');
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }
        }

    });
}

function fntEditarUsuario() {
    $("#tableUsuarios").on("click", "button[data-operacion=editar]", function () {

        document.querySelector('#ModalTitulo').innerHTML = "Actualizar Usuario";
        document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
        document.querySelector('#btnText').innerHTML = " Actualizar";

        let idusuario = this.getAttribute("data-id");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/usuario/getIdUsuario/' + idusuario;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);

                if (objData.resultado) {
                    document.querySelector("#txtidusuario").value = objData.data.idusuario;
                    document.querySelector("#txtnom").value = objData.data.nombres;
                    document.querySelector("#txtapell").value = objData.data.apellidos;
                    document.querySelector("#txtfechanac").value = objData.data.fechanac;
                    document.querySelector("#txtcorreo").value = objData.data.correo;
                    document.querySelector("#txtcel").value = objData.data.celular;
                    document.querySelector("#foto_actual").value = objData.data.imagen;
                    document.querySelector("#foto_remove").value = 0;
                    document.querySelector("#txtdni").value = objData.data.dni;
                    document.querySelector("#cborol").value = objData.data.idrol;
                    //document.querySelector("#viewGenero").innerHTML = objData.data.genero;
                    document.querySelector("#cboestado").value = objData.data.estado;
                    document.querySelector("#txtuser").value = objData.data.nombreusuario;
                     $('#cboestado').selectpicker('render');
                     $('#cborol').selectpicker('render');

                    if(document.querySelector('#img')){
                        document.querySelector('#img').src = objData.data.url_imagen;
                    }else{
                        document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objData.data.url_imagen+" class='renderizar' />";
                    }

                    if(objData.data.imagen == 'user-default.png'){
                        document.querySelector('#xfoto').classList.add("notblock");
                    }else{
                        document.querySelector('#xfoto').classList.remove("notblock");
                    }
                     
                }
            }
            $('#modalFormUsuario').modal('show');
        }
    });

}

function fntEliminarUsuario() {
    $("#tableUsuarios").on("click", "button[data-operacion=eliminar]", function () {

        let idusuario = this.getAttribute("data-id");

        swal.fire({
            title: '¿Desea continuar?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#9c9c9c',
            confirmButtonText: '¡Sí, bórralo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = base_url + '/usuario/delUsuario';
                let strData = "idusuario=" + idusuario;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);

                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {

                        let objData = JSON.parse(request.responseText);

                        if (objData.resultado) {

                            Swal.fire("Atención!", objData.msg, "success");

                            tableUsuarios.api().ajax.reload();

                        } else {
                            Swal.fire("Atención!", objData.msg, "error");
                        }

                    }
                }

            }
        });

    });
}

function removePhoto(){
    document.querySelector('#txtfoto').value ="";
    document.querySelector('#xfoto').classList.add("notblock");
    if(document.querySelector('#img')){
        document.querySelector('#img').remove();
    }
}


$("#btnNuevoUsuario").click(function () {
    document.querySelector('#txtidusuario').value = "";
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = " Guardar";
    document.querySelector('#ModalTitulo').innerHTML = "Registro de Usuario";
    document.querySelector("#formUsuario").reset();
    $('#cborol').selectpicker('render');
    $('#modalFormUsuario').modal('show');
    removePhoto();
});

let tableProveedor;
//LOGO RESPONSIVE PROVEEDOR
document.addEventListener('DOMContentLoaded', function () {

    tableProveedor = $("#tableProveedor").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": base_url + "/assets/admin-estilos/js/espanol.json"
        },
        "ajax": {
            "url": " " + base_url + "/proveedor/getProveedor",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idempresa" },
            { "data": "imagen",
                render: function (data, type, row) {
                    //return "<img src='"+data+"' alt='"+data+"'/>";
                    return "<img src='"+base_url+"/assets/vendors/images/empresa/"+data+"' class='border-radius-100 imginfo shadow' width='40' height='40' alt='' />";
                }
            },
            { "data": "razonsocial" },
            { "data": "ruc" },
            { "data": "movil" },
            { "data": "correo" },
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
                document.querySelector('.prevPhotoProv div').innerHTML = "<img id='img' src="+objeto_url+">";
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


    let formProveedor = document.querySelector("#formProveedor");
    formProveedor.onsubmit = function (e) {
        e.preventDefault();

        let idproveedor = document.querySelector('#txtidproveedor').value;
        let razonsocial = document.querySelector('#txtrazons').value;
        let nombrecomercial = document.querySelector('#txtnomcom').value;
        let ruc = document.querySelector('#txtruc').value;
        let movil = document.querySelector('#txtmovil').value;
        let fijo = document.querySelector('#txtfijo').value;
        let direc = document.querySelector('#txtdirec').value;
        let correo = document.querySelector('#txtcorreo').value;
        let estado = document.querySelector('#cboestado').value;

        if (razonsocial == '' || ruc == '') {
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
        let ajaxUrl = base_url + '/proveedor/setProveedor';
        let formData = new FormData(formProveedor);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                //console.log(request.responseText);
                let objData = JSON.parse(request.responseText);
                if (objData.resultado) {
                    $('#modalFormProveedor').modal('hide');
                    formProveedor.reset();
                    Swal.fire("Atención!", objData.msg, "success");
                    removePhoto();
                    tableProveedor.api().ajax.reload();
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }
        }

    }


}, false);


window.addEventListener('load', function () {
    fntViewProveedor();
    fntEditarProveedor();
    fntEliminarProveedor();
}, false);

function fntViewProveedor() {

    $("#tableProveedor").on("click", "button[data-operacion=ver]", function () {

        let idproveedor = this.getAttribute("data-id");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/proveedor/getIdProveedor/' + idproveedor;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);

                if (objData.resultado) {

                    let estadoUsuario = objData.data.estado == 1 ?
                        '<span class="badge badge-success">Activo</span>' :
                        '<span class="badge badge-danger">Desactivado</span>';

                    document.querySelector("#viewId").innerHTML = objData.data.idempresa;
                    document.querySelector("#viewRazons").innerHTML = objData.data.razonsocial;
                    document.querySelector("#viewRUC").innerHTML = objData.data.ruc;
                    document.querySelector("#viewNom").innerHTML = objData.data.nombrecomercial;
                    document.querySelector("#viewCorreo").innerHTML = objData.data.correo;
                    document.querySelector("#viewMov").innerHTML = objData.data.movil;
                    document.querySelector("#ViewFijo").innerHTML = objData.data.fijo;
                    document.querySelector("#viewDirec").innerHTML = objData.data.direccion;
                    document.querySelector("#viewEstado").innerHTML = estadoUsuario;
                    document.querySelector("#viewImagen").innerHTML = '<img src="'+objData.data.url_imagen+'" alt="" class="avatar-photo renderizar" />';
                    document.querySelector("#viewRegis").innerHTML = objData.data.fecharegistro;
                    $('#modalViewProveedor').modal('show');
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }
        }

    });
}

function fntEditarProveedor() {
    $("#tableProveedor").on("click", "button[data-operacion=editar]", function () {

        document.querySelector('#ModalTitulo').innerHTML = "Actualizar Proveedor";
        document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
        document.querySelector('#btnText').innerHTML = " Actualizar";

        let idproveedor = this.getAttribute("data-id");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/proveedor/getIdProveedor/' + idproveedor;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);

                if (objData.resultado) {
                    document.querySelector("#txtidproveedor").value = objData.data.idempresa;
                    document.querySelector("#txtrazons").value = objData.data.razonsocial;
                    document.querySelector("#txtnomcom").value = objData.data.nombrecomercial;
                    document.querySelector("#txtruc").value = objData.data.ruc;
                    document.querySelector("#txtmovil").value = objData.data.movil;
                    document.querySelector("#txtfijo").value = objData.data.fijo;
                    document.querySelector("#foto_actual").value = objData.data.imagen;
                    document.querySelector("#foto_remove").value = 0;
                    document.querySelector("#txtdirec").value = objData.data.direccion;
                    document.querySelector("#txtcorreo").value = objData.data.correo;
                    document.querySelector("#cboestado").value = objData.data.estado;
                    $('#cboestado').selectpicker('render');

                    if(document.querySelector('#img')){
                        document.querySelector('#img').src = objData.data.url_imagen;
                    }else{
                        document.querySelector('.prevPhotoProv div').innerHTML = "<img id='img' src="+objData.data.url_imagen+" class='renderizar' />";
                    }

                    if(objData.data.imagen == 'imagen-default.jpg'){
                        document.querySelector('#xfoto').classList.add("notblock");
                    }else{
                        document.querySelector('#xfoto').classList.remove("notblock");
                    }
                     
                }
            }
            $('#modalFormProveedor').modal('show');
        }
    });

}

function fntEliminarProveedor() {
    $("#tableProveedor").on("click", "button[data-operacion=eliminar]", function () {

        let idproveedor = this.getAttribute("data-id");

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
                let ajaxUrl = base_url + '/proveedor/delProveedor';
                let strData = "idproveedor=" + idproveedor;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);

                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {

                        let objData = JSON.parse(request.responseText);

                        if (objData.resultado) {
                            Swal.fire("Atención!", objData.msg, "success");
                            tableProveedor.api().ajax.reload();
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


$("#btnNuevoProveedor").click(function () {
    document.querySelector('#txtidproveedor').value = "";
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = " Guardar";
    document.querySelector('#ModalTitulo').innerHTML = "Registro de Proveedor";
    document.querySelector("#formProveedor").reset();
    $('#modalFormProveedor').modal('show');
    removePhoto();
});

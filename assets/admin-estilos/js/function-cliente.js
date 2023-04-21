let tableCliente;
//ARREGLAR PARA QUE SE PUEDA GUARDAR 0 - VISTA DE CLIENTE

document.addEventListener('DOMContentLoaded', function () {

    tableCliente = $("#tableCliente").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": base_url + "/assets/admin-estilos/js/espanol.json"
        },
        "ajax": {
            "url": " " + base_url + "/cliente/getClientes",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idcliente" },
            { "data": "nombres" },
            { "data": "dni" },
            { "data": "ruc" },
            { "data": "celular" },
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

    let formCliente = document.querySelector("#formCliente");
    formCliente.onsubmit = function (e) {
        e.preventDefault();

        let idcliente = document.querySelector('#txtidcliente').value;
        let nombre = document.querySelector('#txtnom').value;
        let dni = document.querySelector('#txtdni').value;
        let ruc = document.querySelector('#txtruc').value;
        let celular = document.querySelector('#txtcel').value;
        let correo = document.querySelector('#txtcorreo').value;
        let direc = document.querySelector('#txtdirec').value;
        let estado = document.querySelector('#cboestado').value;

        if (nombre == '') {
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
        let ajaxUrl = base_url + '/cliente/setCliente';
        let formData = new FormData(formCliente);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                console.log(request.responseText);
                let objData = JSON.parse(request.responseText);
                if (objData.resultado) {
                    $('#modalFormCliente').modal('hide');
                    formCliente.reset();
                    Swal.fire("Atención!", objData.msg, "success");
                    tableCliente.api().ajax.reload();
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }
        }

    }


}, false);

window.addEventListener('load', function () {
    fntViewCliente();
    fntEditarCliente();
    fntEliminarCliente();
}, false);

function fntViewCliente() {

    $("#tableCliente").on("click", "button[data-operacion=ver]", function () {

        let idcliente = this.getAttribute("data-id");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/cliente/getIdCliente/' + idcliente;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);

                if (objData.resultado) {

                    let estadoCliente = objData.data.estado == 1 ?
                        '<span class="badge badge-success">Activo</span>' :
                        '<span class="badge badge-danger">Desactivado</span>';

                    document.querySelector("#viewName").innerHTML = objData.data.nombres;
                    document.querySelector("#viewDNI").innerHTML = objData.data.dni;
                    document.querySelector("#viewRUC").innerHTML = objData.data.ruc;
                    document.querySelector("#viewCel").innerHTML = objData.data.celular;
                    document.querySelector("#viewCorreo").innerHTML = objData.data.correo;
                    document.querySelector("#viewDirec").innerHTML = objData.data.direccion;
                    document.querySelector("#viewEstado").innerHTML = estadoCliente;
                    document.querySelector("#viewRegis").innerHTML = objData.data.fecharegistro;
                    $('#modalViewCliente').modal('show');
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }
        }

    });
}

function fntEditarCliente() {
    $("#tableCliente").on("click", "button[data-operacion=editar]", function () {

        document.querySelector('#ModalTitulo').innerHTML = "Actualizar Cliente";
        document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
        document.querySelector('#btnText').innerHTML = " Actualizar";

        let idcliente = this.getAttribute("data-id");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/cliente/getIdCliente/' + idcliente;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);

                if (objData.resultado) {
                    document.querySelector("#txtidcliente").value = objData.data.idcliente;
                    document.querySelector("#txtnom").value = objData.data.nombres;
                    document.querySelector("#txtdni").value = objData.data.dni;
                    document.querySelector("#txtruc").value = objData.data.ruc;
                    document.querySelector("#txtcel").value = objData.data.celular;
                    document.querySelector("#txtcorreo").value = objData.data.correo;
                    document.querySelector("#txtdirec").value = objData.data.direccion;
                    document.querySelector("#cboestado").value = objData.data.estado;
                     $('#cboestado').selectpicker('render');

                }
            }
            $('#modalFormCliente').modal('show');
        }
    });

}

function fntEliminarCliente() {
    $("#tableCliente").on("click", "button[data-operacion=eliminar]", function () {

        let idcliente = this.getAttribute("data-id");

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
                let ajaxUrl = base_url + '/cliente/delCliente';
                let strData = "idcliente=" + idcliente;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);

                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.resultado) {
                            Swal.fire("Atención!", objData.msg, "success");
                            tableCliente.api().ajax.reload();
                        } else {
                            Swal.fire("Atención!", objData.msg, "error");
                        }

                    }
                }

            }
        });

    });
}


$("#btnNuevoCliente").click(function () {
    document.querySelector('#txtidcliente').value = "";
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = " Guardar";
    document.querySelector('#ModalTitulo').innerHTML = "Registro de Cliente";
    document.querySelector("#formCliente").reset();
    $('#modalFormCliente').modal('show');
});
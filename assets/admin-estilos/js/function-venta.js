let table_temp = document.querySelector('#table_temp tbody');

const nombre_cliente = document.querySelector('#nombre-cliente');
const dir_cliente = document.querySelector('#dir-cliente');
const idcliente = document.querySelector('#txtidcliente');

const btnGuardar = document.querySelector('#btnGuardar');
const metodo = document.querySelector('#metodo');

const seacrh = document.querySelector('#seacrh');

let tableCliente, tableVenta;

document.addEventListener('DOMContentLoaded', function () {

    tableVenta = $("#tableVenta").dataTable({
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
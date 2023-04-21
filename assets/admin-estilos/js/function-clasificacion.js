let tableClasificacion;

document.addEventListener('DOMContentLoaded', function () {

    tableClasificacion = $("#tableClasificacion").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": base_url + "/assets/admin-estilos/js/espanol.json"
        },
        "ajax": {
            "url": " " + base_url + "/clasificacion/getClasificacion",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idclasificacion" },
            { "data": "clasificacion" },
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

    let formClasificacion = document.querySelector("#formClasificacion");
    formClasificacion.onsubmit = function (e) {
        e.preventDefault();

        let idclasificacion = document.querySelector('#txtidclasificacion').value;
        let nombre = document.querySelector('#txtnom').value;
        let estado = document.querySelector('#cboestado').value;

        if (nombre == '' || estado == '') {
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
        let ajaxUrl = base_url + '/clasificacion/setClasificacion';
        let formData = new FormData(formClasificacion);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                console.log(request.responseText);
                let objData = JSON.parse(request.responseText);
                if (objData.resultado) {
                    $('#modalformClasificacion').modal('hide');
                    formClasificacion.reset();
                    Swal.fire("Clasificación", objData.msg, "success");
                    tableClasificacion.api().ajax.reload();
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }
        }

    }


}, false);


window.addEventListener('load', function () {
    fntEditarClasificacion();
    fntEliminarClasificacion();
}, false);


function fntEditarClasificacion() {
    $("#tableClasificacion").on("click", "button[data-operacion=editar]", function () {

        document.querySelector('#ModalTitulo').innerHTML = "Actualizar Clasificación";
        document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
        document.querySelector('#btnText').innerHTML = " Actualizar";

        let idclasificacion = this.getAttribute("data-id");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/clasificacion/getidclasificacion/' + idclasificacion;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);

                if (objData.resultado) {
                    document.querySelector("#txtidclasificacion").value = objData.data.idclasificacion;
                    document.querySelector("#txtnom").value = objData.data.clasificacion;
                    document.querySelector("#cboestado").value = objData.data.estado;
                }
            }
            $('#modalformClasificacion').modal('show');
        }
    });

}

function fntEliminarClasificacion() {
    $("#tableClasificacion").on("click", "button[data-operacion=eliminar]", function () {
        let idclasificacion = this.getAttribute("data-id");

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
                let ajaxUrl = base_url + '/clasificacion/delClasificacion';
                let strData = "idclasificacion=" + idclasificacion;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);

                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {

                        let objData = JSON.parse(request.responseText);

                        if (objData.resultado) {
                            Swal.fire("Atención!", objData.msg, "success");
                            tableClasificacion.api().ajax.reload();
                        } else {
                            Swal.fire("Atención!", objData.msg, "error");
                        }

                    }
                }

            }
        });

    });
}


$("#btnNuevoClasificacion").click(function () {
    document.querySelector('#txtidclasificacion').value = "";
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = " Guardar";
    document.querySelector('#ModalTitulo').innerHTML = "Registro de Clasificación";
    document.querySelector("#formClasificacion").reset();
    $('#modalformClasificacion').modal('show');
});

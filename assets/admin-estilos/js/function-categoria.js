let tableCategorias;

document.addEventListener('DOMContentLoaded', function () {

    tableCategorias = $("#tableCategoria").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": base_url + "/assets/admin-estilos/js/espanol.json"
        },
        "ajax": {
            "url": " " + base_url + "/categoria/getCategoria",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idcategoria" },
            { "data": "categoria" },
            { "data": "descripcion" },
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

    let formCategoria = document.querySelector("#formCategoria");
    formCategoria.onsubmit = function (e) {
        e.preventDefault();

        let idcategoria = document.querySelector('#txtidcategoria').value;
        let nombre = document.querySelector('#txtnom').value;
        let descripcion = document.querySelector('#txtdesc').value;
        let clasificacion = document.querySelector('#cboclas').value;
        let estado = document.querySelector('#cboestado').value;
        $('#cboclas').selectpicker('render');

        if (nombre == '' || descripcion == '' || clasificacion == '' || estado == '') {
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
        let ajaxUrl = base_url + '/categoria/setCategoria';
        let formData = new FormData(formCategoria);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                console.log(request.responseText);
                let objData = JSON.parse(request.responseText);
                if (objData.resultado) {
                    $('#modalformCategoria').modal('hide');
                    formCategoria.reset();
                    Swal.fire("Categorías", objData.msg, "success");
                    tableCategorias.api().ajax.reload();
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }
        }

    }


}, false);


window.addEventListener('load', function () {
    fntClasificaciones();
    fntEditarCategoria();
    fntEliminarCategoria();
}, false);


function fntClasificaciones() {
    let ajaxUrl = base_url + '/clasificacion/getSeleccionarClasificacion';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#cboclas').innerHTML = request.responseText;
            $('#cboclas').selectpicker('render');
        }
    }

}

function fntEditarCategoria() {
    $("#tableCategoria").on("click", "button[data-operacion=editar]", function () {

        document.querySelector('#ModalTitulo').innerHTML = "Actualizar Categoría";
        document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
        document.querySelector('#btnText').innerHTML = " Actualizar";

        let idcategoria = this.getAttribute("data-id");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/categoria/getidcategoria/' + idcategoria;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);

                if (objData.resultado) {
                    document.querySelector("#txtidcategoria").value = objData.data.idcategoria;
                    document.querySelector("#txtnom").value = objData.data.categoria;
                    document.querySelector("#txtdesc").value = objData.data.descripcion;
                    document.querySelector("#cboclas").value = objData.data.idclasificacion;
                    document.querySelector("#cboestado").value = objData.data.estado;
                    $('#cboclas').selectpicker('render');
                }
            }
            $('#modalformCategoria').modal('show');
        }
    });

}

function fntEliminarCategoria() {
    $("#tableCategoria").on("click", "button[data-operacion=eliminar]", function () {

        let idcategoria = this.getAttribute("data-id");
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
                let ajaxUrl = base_url + '/categoria/delCategoria';
                let strData = "idcategoria=" + idcategoria;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);

                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);

                        if (objData.resultado) {
                            Swal.fire("Atención!", objData.msg, "success");
                            tableCategorias.api().ajax.reload();
                        } else {
                            Swal.fire("Atención!", objData.msg, "error");
                        }

                    }
                }

            }
        });

    });
}


$("#btnNuevoCategoria").click(function() {
    document.querySelector('#txtidcategoria').value = "";
    $('#cboclas').selectpicker('render');
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = " Guardar";
    document.querySelector('#ModalTitulo').innerHTML = "Registro de Categoría";
    document.querySelector("#formCategoria").reset();
    $('#modalformCategoria').modal('show');
});

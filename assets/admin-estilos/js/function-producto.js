//PLUGINS DE JSBARCODE
//GALERIA DE IMAGEN - PROVEDOR
document.write(`<script src="${base_url}/assets/src/plugins/jsBarcode/jsbarcode.min.js"></script>`);

let tableProductos;

//PLUGINS DE TEXTAREA
tinymce.init({
    selector: '#txtdesc',
    width: "100%",
    height: 520,
    statubar: true
});

$("#txtcod").click(function () {
    let inputCodigo = document.querySelector("#txtcod");
    inputCodigo.onkeyup = function () {
        if (inputCodigo.value.length >= 5) {
            document.querySelector('#divBarCode').classList.remove("notblock");
            fntBarcode();
        } else {
            document.querySelector('#divBarCode').classList.add("notblock");
        }
    }
});

    tableProductos = $("#tableProductos").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": base_url + "/assets/admin-estilos/js/espanol.json"
        },
        "ajax": {
            "url": " " + base_url + "/producto/getProducto",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idproducto" },
            { "data": "portada",
                render: function (data, type, row) {
                    return "<img src='"+base_url+"/assets/vendors/images/producto/"+data+"' class='border-radius-100 imginfo shadow' width='40' height='40' alt='' />";
                }
            },
            { "data": "codigobarra" },
            { "data": "nombreproducto" },
            { "data": "preciocompra" },
            { "data": "precioventa" },
            { "data": "stock" },
            { "data": "categoria" },
            { "data": "estado" },
            { "data": "opcion" }
        ],
        "columnDefs": [
            { 'className': "textright", "targets": [ 3 ] },
            { 'className': "textright", "targets": [ 4 ] },
            { 'className': "textcenter", "targets": [ 5 ] },
            { 'className': "textcenter", "targets": [ 8 ] }
          ], 
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copy",
                "text": "<i class='icon-copy fa fa-copy' aria-hidden='true'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary btn-sm",
                "exportOptions": { 
                    "columns": [ 0, 1, 2, 3, 4, 5, 6, 7] 
                }
            }, {
                "extend": "excel",
                "text": "<i class='icon-copy fa fa-file-excel-o' aria-hidden='true'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success btn-sm",
                "exportOptions": { 
                    "columns": [ 0, 1, 2, 3, 4, 5, 6, 7] 
                }
            }, {
                "extend": "pdf",
                "text": "<i class='icon-copy fa fa-file-pdf-o' aria-hidden='true'></i> PDF",
                "titleAttr": "Exportar a PDF",
                "className": "btn btn-danger btn-sm",
                "exportOptions": { 
                    "columns": [ 0, 1, 2, 3, 4, 5, 6, 7] 
                }
            }, {
                "extend": "csv",
                "text": "<i class='icon-copy bi bi-filetype-csv' aria-hidden='true'></i> CSV",
                "titleAttr": "Exportar a CSV",
                "className": "btn btn-info btn-sm",
                 "exportOptions": { 
                    "columns": [ 0, 1, 2, 3, 4, 5, 6, 7] 
                }
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
                document.querySelector('.prevPhotoProd div').innerHTML = "<img id='img' src="+objeto_url+">";
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

    window.addEventListener('load', function() {
      if(document.querySelector("#formProducto")){
        let formProducto = document.querySelector("#formProducto");
        formProducto.onsubmit = function (e) {
            e.preventDefault();

            let idproducto = document.querySelector('#txtidproducto').value;
            let idmarca = document.querySelector('#cbomarca').value;
            let idcategoria = document.querySelector('#cboCat').value;
            let idpresentacion = document.querySelector('#cbopresent').value;
            let codigo = document.querySelector('#txtcod').value;
            let sku = document.querySelector('#txtsku').value;
            let nombre = document.querySelector('#txtnom').value;
            let descripcion = document.querySelector('#txtdesc').value;
            let tipo = document.querySelector('#cbotprod').value;
            let stock = document.querySelector('#txtstock').value;
            let stockmin = document.querySelector('#txtstockmin').value;
            let pcompra = document.querySelector('#txtpcompra').value;
            let pventa = document.querySelector('#txtpventa').value;
            let descuento = document.querySelector('#txtdescuento').value;
            let modelo = document.querySelector('#txtmodel').value;
            //let portada = document.querySelector('#txtfoto').value;
            let estado = document.querySelector('#cboestado').value;

            if (idmarca == '' || idcategoria == '' || idpresentacion == '' || codigo == '' ||
                sku == '' || nombre == '' || descripcion == '' || tipo == '' || stock == '' ||
                stockmin == '' || pcompra == '' || pventa == '' || descuento == '' ||
                modelo == '' || estado == '') {
                Swal.fire("Atención", "Todos los campos son obligatorios(*)", "error");
            return false;
        }

        if (codigo.length < 5) {
            Swal.fire("Atención", "El código debe ser mayor que 5 dígitos.", "error");
            return false;
        }

    //Textarea plugins
        tinymce.triggerSave();

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
            if (elementsValid[i].classList.contains('form-control-danger')) {
                Swal.fire("Atención", "Por favor verifique los campos en rojo.", "error");
                return false;
            }
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/producto/setProducto';
        let formData = new FormData(formProducto);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
            //console.log(request.responseText);
                let objData = JSON.parse(request.responseText);
                if (objData.resultado) {
                    $('#modalformProducto').modal('hide');
                    formProducto.reset();
                    Swal.fire("Productos", objData.msg, "success");
                    removePhoto();
                    tableProductos.api().ajax.reload();
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }

        }

    }
}

    fntMarcas();
    fntEditarProducto();
    fntEliminarProducto();
    //fntImagenProducto();
    //fntCategorias();
}, false);

    function fntMarcas(){
       if(document.querySelector('#cbomarca')){
        let ajaxUrl = base_url + '/marca/getSeleccionarMarca';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#cbomarca').innerHTML = request.responseText;
                $('#cbomarca').selectpicker('render');
            }
        }
    }
}



/*function fntViewUsuario() {

    $("#tableProductos").on("click", "button[data-operacion=ver]", function () {

        let idproducto = this.getAttribute("data-id");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/usuario/getidproducto/' + idproducto;
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
                    document.querySelector("#viewclasificacion").innerHTML = objData.data.clasificacion;
                    document.querySelector("#viewDNI").innerHTML = objData.data.dni;
                    document.querySelector("#viewCel").innerHTML = objData.data.celular;
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
}*/

/*function fntImagenProducto() {
    $("#tableProductos").on("click", "button[data-operacion=imagen]", function () {

         $("#btnImagenProducto").click(function () {
            let key = Date.now();
            let newElement = document.createElement("div");
            newElement.id= "div"+key;
            newElement.innerHTML = `
                <div class="da-card box-shadow">
                    <div class="da-card-photo">
                      <div class="">
                        </div>
                        <div class="da-overlay">
                            <div class="da-social">
                                <h5 class="mb-10 color-white pd-20">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing.
                                </h5>
                                <ul class="clearfix">
                                    <li>
                                        <a href="<?= media(); ?>/vendors/images/product-img1.jpg"
                                            data-fancybox="images"><i class="icon-copy fa fa-picture-o"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" id="btnElimImg" ><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>`;
            document.querySelector("#containerImages").appendChild(newElement);
            //document.querySelector("#div"+key+" .btnUploadfile").click();
            //fntInputFile();
        });

        $('#modalImgProducto').modal('show');
    });

}*/

/*function fntInputFile(){
    let idproducto = document.querySelector("#txtidproducto").value;
    let parentId = this.parentNode.getAttribute("id");
    let idFile = this.getAttribute("id");            
    let uploadFoto = document.querySelector("#"+idFile).value;
    let fileimg = document.querySelector("#"+idFile).files;
    let prevImg = document.querySelector("#"+parentId+" .prevImage");
    let nav = window.URL || window.webkitURL;
    if(uploadFoto !=''){
        let type = fileimg[0].type;
        let name = fileimg[0].name;
        if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
            prevImg.innerHTML = "Archivo no válido";
            uploadFoto.value = "";
            return false;
        }else{
            let objeto_url = nav.createObjectURL(this.files[0]);
            prevImg.innerHTML = `<img class="loading" src="${base_url}/assets/vendors/images/loading.svg" >`;

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/producto/setImage'; 
            let formData = new FormData();
            formData.append('idproducto',idproducto);
            formData.append("foto", this.files[0]);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState != 4) return;
                if(request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status){
                        prevImg.innerHTML = `<img src="${objeto_url}">`;
                        document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname",objData.imgname);
                        document.querySelector("#"+parentId+" .btnUploadfile").classList.add("notblock");
                        document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notblock");
                    }else{
                        Swal.fire("Error", objData.msg , "error");
                    }
                }
            }

        }
    }

}*/


function fntEditarProducto() {
    $("#tableProductos").on("click", "button[data-operacion=editar]", function () {

        document.querySelector('#ModalTitulo').innerHTML = "Actualizar Producto";
        document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
        document.querySelector('#btnText').innerHTML = " Actualizar";

        let idproducto = this.getAttribute("data-id");
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url + '/producto/getIdProducto/' + idproducto;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);

                if (objData.resultado) {
                    document.querySelector("#txtidproducto").value = objData.data.idproducto;
                    document.querySelector("#cbomarca").value = objData.data.idmarca;
                    document.querySelector("#cboCat").value = objData.data.idcategoria;
                    document.querySelector("#cbopresent").value = objData.data.idpresentacion;
                    document.querySelector("#txtcod").value = objData.data.codigobarra;
                    document.querySelector("#txtsku").value = objData.data.sku;
                    document.querySelector("#txtnom").value = objData.data.nombreproducto;
                    //document.querySelector("#txtdesc").value = objData.data.descripcion;
                    tinymce.activeEditor.setContent(objData.data.descripcion);
                    document.querySelector("#cbotprod").value = objData.data.tipo;
                    document.querySelector("#txtstock").value = objData.data.stock;
                    document.querySelector("#txtstockmin").value = objData.data.stockmin;
                    document.querySelector("#txtpcompra").value = objData.data.preciocompra;
                    document.querySelector("#txtpventa").value = objData.data.precioventa;
                    document.querySelector("#txtdescuento").value = objData.data.descuento;
                    document.querySelector("#txtmodel").value = objData.data.modelo;
                    document.querySelector("#cboestado").value = objData.data.estado;
                    document.querySelector("#foto_actual").value = objData.data.portada;
                    document.querySelector("#foto_remove").value = 0;

                    $('#cbomarca').selectpicker('render');
                    $('#cboCat').selectpicker('render');
                    $('#cbopresent').selectpicker('render');
                    $('#cbotprod').selectpicker('render');
                    $('#cboestado').selectpicker('render');
                    fntBarcode();
                    document.querySelector("#divBarCode").classList.remove("notblock");

                    // IMAGEN PRODUCTO
                    if(document.querySelector('#img')){
                        document.querySelector('#img').src = objData.data.url_imagen;
                    }else{
                        document.querySelector('.prevPhotoProd div').innerHTML = "<img id='img' src="+objData.data.url_imagen+" class='renderizar' />";
                    }

                    if(objData.data.portada == 'user-default.png'){
                        document.querySelector('#xfoto').classList.add("notblock");
                    }else{
                        document.querySelector('#xfoto').classList.remove("notblock");
                    }
                }
            }
            $('#modalformProducto').modal('show');
        }
    });

}

function fntEliminarProducto() {
    $("#tableProductos").on("click", "button[data-operacion=eliminar]", function () {

        let idproducto = this.getAttribute("data-id");

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
                let ajaxUrl = base_url + '/producto/delProducto';
                let strData = "idproducto=" + idproducto;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);

                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);

                        if(objData.resultado) {
                            Swal.fire("Atención!", objData.msg, "success");
                            tableProductos.api().ajax.reload();
                            removePhoto();
                        } else {
                            Swal.fire("Atención!", objData.msg, "error");
                        }

                    }
                }

            }
        });

    });
}

//LISTADO DE CATEGORIAS
if(document.querySelector('#cboCat')){
    let ajaxUrl = base_url + '/categoria/getSeleccionarCategoria';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#cboCat').innerHTML = request.responseText;
            $('#cboCat').selectpicker('render');
        }
    }
}

//LISTADO DE PRESENTACIONES
if(document.querySelector('#cbopresent')){
    let ajaxUrl = base_url + '/presentacion/getSeleccionarPresentacion';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#cbopresent').innerHTML = request.responseText;
            $('#cbopresent').selectpicker('render');
        }
    }
}

function fntBarcode() {
    let codigo = document.querySelector("#txtcod").value;
    JsBarcode("#barcode", codigo);
}

function fntPrintBarcode(area) {
    let elemntArea = document.querySelector(area);
    let vprint = window.open(' ', 'popimpr', 'height=400,width=600');
    vprint.document.write(elemntArea.innerHTML);
    vprint.document.close();
    vprint.print();
    vprint.close();
}

function removePhoto(){
    document.querySelector('#txtfoto').value = "";
    document.querySelector('#xfoto').classList.add("notblock");
    if(document.querySelector('#img')){
        document.querySelector('#img').remove();
    }
}


$("#btnNuevoProducto").click(function () {
    document.querySelector('#txtidproducto').value = "";
    document.querySelector('#divBarCode').classList.add("notblock");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = " Guardar";
    document.querySelector('#ModalTitulo').innerHTML = "Registro de Producto";
    document.querySelector("#formProducto").reset();
    $('#modalformProducto').modal('show');
    removePhoto();
});

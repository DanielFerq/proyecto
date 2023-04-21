//OBATNER EL ID COMPRA, DESPUES DE REGISTRAR COMPRA


let table_temp = document.querySelector('#table_temp tbody');
let table_tempCompra = document.querySelector('#table_temp');
const request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

const inputBuscarCodigo = document.querySelector('#buscarProductoCodigo');
const inputBuscarNombre = document.querySelector('#buscarProductoNombre');
const barcode = document.querySelector('#barcode');
const nombre = document.querySelector('#nombre');
const containerCodigo = document.querySelector('#containerCodigo');
const containerNombre = document.querySelector('#containerNombre');

//PROVEEDOR 
const txtidProv = document.querySelector('#txtidproveedor');
const txtserie = document.querySelector('#txtSerie');
const txtnomProv = document.querySelector('#txtNom');
const txtcelProv = document.querySelector('#txtCel');
const txtcorrProv = document.querySelector('#txtCorr');

const btnAccion = document.querySelector('#btnAccion');
const totalPagar = document.querySelector('#totalPagar');

//para filtro por rango de fechas
const desde = document.querySelector('#desde');
const hasta = document.querySelector('#hasta');

//Para alert Toast
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

let listaCarrito, tableCompra, tableProveedor;


document.addEventListener('DOMContentLoaded', function() {

    tableCompra = $("#tableCompra").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": base_url + "/assets/admin-estilos/js/espanol.json"
        },
        "ajax": {
            "url": " " + base_url + "/producto/getProductoCart",
            "dataSrc": ""
        },
        "columns": [
            { "data": "codigobarra" },
            { "data": "nombreproducto" },
            { "data": "cantidad" },
            { "data": "precioventa" },
            { "data": "addcart" }
            ],
       // "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

    temporalCompra();
    temp();

    tableProveedor = $("#tableListProveedor").dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": base_url + "/assets/admin-estilos/js/espanol.json"
        },
        "ajax": {
            "url": " " + base_url + "/proveedor/getProveedorAdd",
            "dataSrc": ""
        },
        "columns": [
            { "data": "razonsocial" },
            { "data": "ruc" },
            { "data": "movil" },
            { "data": "correo" },
            { "data": "addproved" }
            ],
       // "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

    window.addEventListener('load', function () {
       //temporalCompra();
    }, false);
    
    //CLICK BTN OPCION AGREGAR PRODUCTO
    $("#tableCompra").on("click", "button[data-operacion=agregar]", function(){ 
        var idproducto = this.getAttribute("data-id");
        var ajaxUrl = base_url+'/compra/addCart/'+idproducto;
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
          
          if(request.readyState == 4 && request.status == 200){
            //console.log(request.responseText);
            var objData = JSON.parse(request.responseText);
            if(objData.resultado){
                  Toast.fire({icon: objData.tipo, title: objData.msg});
                  temporalCompra();
            }else{
                Toast.fire({icon: objData.tipo, title: objData.msg});
           }  
           
         }
       }    
       
     });

    //TABLA DE COMPRA
    function temporalCompra() {
        let ajaxUrl = base_url + '/compra/listarTemp';
        request.open("GET", ajaxUrl, true);
        request.send();
        let tempProductos = '';

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                //console.log(request.responseText);
                 let objData = JSON.parse(request.responseText);
                    objData.forEach(data => {
                        tempProductos += `<tr>
                            <td>${data.nombreproducto}</td>
                            <td><input class="form-control" type="number" data-operacion="addPrecio" value="${data.precio}" data-idp="${data.idtempcompra}"/></td>
                            <td><input class="form-control" type="number" data-operacion="addCantidad" value="${data.cantidad}" data-idc="${data.idtempcompra}"/></td>
                            <td>${parseFloat(data.precio) * parseInt(data.cantidad)}</td>
                            <td>
                                <div class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" data-operacion="eliminar" data-id="${data.idtempcompra}" title="Eliminar producto">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                                </div>
                            </td>
                        </tr>`; 
                    });
                    
                table_temp.innerHTML = tempProductos; 
            }
        }
        
      }

    $("#table_temp").on("click", "button[data-operacion=eliminar]", function () {
        let idtempcompra = this.getAttribute("data-id");
        let ajaxUrl = base_url+'/compra/delTempCompra/'+idtempcompra;
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
          
          if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            
            if(objData.resultado){
                  Toast.fire({icon: objData.tipo, title: objData.msg});
                  temporalCompra();
            }else{
                Toast.fire({icon: objData.tipo, title: objData.msg});
           }  
           
         }
       }   

    });

   //MODIFICAR CANTIDAD EN LA TABLA TEMP
    $("#table_temp").on('keyup change', "input[data-operacion=addCantidad]", function () {
        //Obtenemos ID y VALor del input
        let idtempcompra = this.getAttribute("data-id");
        let cantidad = $(this).val();

        let ajaxUrl = base_url+'/compra/addTempCantidad';
        let strData = "idtempcompra=" + idtempcompra +"&cantidad="+cantidad;
        request.open("POST", ajaxUrl, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(strData);
        temporalCompra();      
    });

    //MODIFICAR PRECIO EN LA TABLA TEMP
    function temp(){

        $("#table_temp").on('change', "input[data-operacion=addPrecio]", function () {
            let idtempcompra = this.getAttribute("data-idp");
            let precio = $(this).val();

            let ajaxUrl = base_url+'/compra/addTempPrecio';
            let strData = "idtempcompra=" + idtempcompra +"&precio="+precio;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            temporalCompra();      
        });
    }

    
    
    //comprobar productos en localStorage
    //if(localStorage.getItem('posCompra') != null) {
        //listaCarrito = JSON.parse(localStorage.getItem(nombreKey));
       // listaCarrito = [];
    //}

    //mostrar input para la busqueda por nombre
    nombre.addEventListener('click', function () {
        containerCodigo.classList.add('d-none');
        containerNombre.classList.remove('d-none');
        inputBuscarNombre.value = '';
        inputBuscarNombre.focus();
    });

    //mostrar input para la busqueda por codigo
    barcode.addEventListener('click', function () {
        containerNombre.classList.add('d-none');
        containerCodigo.classList.remove('d-none');
        inputBuscarCodigo.value = '';
        inputBuscarCodigo.focus();
    });

    inputBuscarCodigo.addEventListener('keyup', function (e) {
        if (e.keyCode === 13) {
          buscarProducto(e.target.value);
        }
        return;
    });

/*     $("#buscarProductoNombre").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: base_url + 'producto/buscarxNombre',
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            console.log(ui.item);
            agregarProducto(ui.item.id, 1, ui.item.stock);
            inputBuscarNombre.value = '';
            inputBuscarNombre.focus();
            return false; 
        }
    }); */

},false);


$("#btnAddProveedor").click(function () {
    $('#modal_listProveedor').modal('show');

    $("#tableListProveedor").on("click", "button[data-operacion=agregar]", function () {
        let idproveedor = this.getAttribute("data-id");
        let ajaxUrl = base_url + '/proveedor/getIdProveedor/' + idproveedor;
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);
                if (objData.resultado) {
                    document.querySelector("#txtidproveedor").value = objData.data.idempresa;
                    document.querySelector("#viewNom").value = objData.data.razonsocial;
                    document.querySelector("#viewCel").value = objData.data.movil;
                    document.querySelector("#viewCorr").value = objData.data.correo;
                    $('#modal_listProveedor').modal('hide');
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }
        }
    });
}); 

function buscarProducto(valor){
    let ajaxUrl = base_url + '/producto/buscarxCodigo/' + valor;
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            //console.log(request.responseText);
            const resultado = JSON.parse(this.responseText);
            if(resultado.estado){
                agregarProducto(resultado.datos.idproducto, 1, resultado.datos.cantidad);
            }else{
                alertaPersonalizada('warning', 'CODIGO NO EXISTE');   
            }
            inputBuscarCodigo.value = '';
            inputBuscarCodigo.focus();
        }
    }
}

function agregarProducto(idproducto, cantidad) {
    if(localStorage.getItem('posCompra') == null){
        listaCarrito =[];
    }

    listaCarrito.push({
        id: idproducto,
        cantidad: cantidad
    });
    localStorage.setItem('posCompra', JSON.stringify(listaCarrito));
}

$("#btnSaveCompra").click(function(){
    let ajaxUrl = base_url + '/compra/saveCompra';
    let strData = "idproveedor=" + txtidProv.value + "&serie="+txtserie.value;
    request.open("POST", ajaxUrl, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(strData);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            //console.log(request.responseText);
            let objData = JSON.parse(request.responseText);
            if (objData.resultado) {
                //temporalCompra();
                Toast.fire({icon: objData.tipo, title: objData.msg});
                //table_temp.api().ajax.reload();
            } else {
                Toast.fire({icon: objData.tipo, title: objData.msg});
            } 
        }
    }

});

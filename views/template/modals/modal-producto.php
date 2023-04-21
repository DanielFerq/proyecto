<div class="modal fade" id="modalformProducto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="modal-header">
        <h5 id="ModalTitulo" class="modal-title">Registro de Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProducto" enctype="multipart/form-data" name="formProducto" autocomplete="off">
          <input type="hidden" id="txtidproducto" name="txtidproducto" value="">
          <input type="hidden" id="foto_actual" name="foto_actual" value="">
          <input type="hidden" id="foto_remove" name="foto_remove" value="0">
          <p class="text-primary">Todos los campos son obligatorio (*).</p>
           <!-- <p class="text-secondary">Resolución recomendada 500px X 500px o superior manteniendo el aspecto cuadrado (1:1).</p> -->

          <div id="divBarCode" class="row notblock">
            <div class="col-md-12 col-sm-12">
              <div class="form-group text-center">
                <div id="printCode">
                  <svg id="barcode"></svg>
                </div>
                <button class="btn btn-success btn-sm" type="button" onClick="fntPrintBarcode('#printCode')"><i
                  class="icon-copy bi bi-printer"></i>
                Imprimir</button>
              </div>
            </div>
          </div> 

          <div class="row">
            <div class="col-md-8 col-sm-12">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtcod">*Código de barra:</label>
                    <input type="text" class="form-control" id="txtcod" name="txtcod" placeholder="Ejem. 145682432.">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txtsku">SKU:</label>
                    <input type="text" class="form-control" id="txtsku" name="txtsku" placeholder="Ejem. RM034-LPS">
                  </div>
                </div>
              </div>


              <div class="form-group">
                <label for="txtnom">*Nombre del producto:</label>
                <input type="text" class="form-control" id="txtnom" name="txtnom">
              </div>
              <div class="form-group">
                <label for="txtdesc">Descripción del producto:</label>
                <textarea type="text" class="form-control" id="txtdesc" name="txtdesc"></textarea>
              </div>
            </div>

            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtfoto">Imagen aspecto cuadrado (1:1):</label>
                <div class="prevPhotoProd">
                  <span id="xfoto" class="delPhoto notblock">X</span>
                  <label for="txtfoto"></label>
                  <div>
                    <img id="img" src="<?= media(); ?>/vendors/images/producto/producto-default.png">
                  </div>
                </div>
                <div class="upimg">
                  <input accept="image/png,image/jpeg" type="file" name="txtfoto" id="txtfoto">
                </div>
                <div id="form_alert"></div>
              </div>

              <div class="form-group">
                <label for="cboCat">*Categoría:</label>
                <select id="cboCat" data-live-search="true" name="cboCat" class="form-control" required="">
                </select>
              </div>
              <div class="form-group">
                <label for="cbomarca">*Marca:</label>
                <select id="cbomarca" data-live-search="true" name="cbomarca" class="form-control" required="">
                </select>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="txtmodel">Modelo:</label>
                  <input type="text" class="form-control" id="txtmodel" name="txtmodel" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="cbotprod">*Tipo de producto:</label>
                <select id="cbotprod" name="cbotprod" class="form-control" required="">
                  <option value="1">Físico</option>
                  <option value="2">Digital</option>
                </select>
              </div>
              <div class="form-group">
                <label for="cbopresent">*Presentación de producto:</label>
                <select id="cbopresent" name="cbopresent" class="form-control" data-live-search="true">
                  <!-- <option value="PT00000001">1.- Unidad</option>
                  <option value="PT00000002">2.- Libra</option> -->
                </select>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="txtstock">*Stock:</label>
                    <input type="number" class="form-control" id="txtstock" name="txtstock" min="0" placeholder="0"
                    value="0">
                  </div>  
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="txtstockmin">*Stock Min:</label>
                    <input type="number" class="form-control" id="txtstockmin" name="txtstockmin" min="0" placeholder="0"
                    value="0">
                  </div> 
                </div>
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label for="txtpcompra">*Precio Compra:</label>
                <input type="number" class="form-control" id="txtpcompra" name="txtpcompra" min="0" placeholder="0"
                value="0">
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label for="txtpventa">*Precio Venta:</label>
                <input type="number" class="form-control" id="txtpventa" name="txtpventa" min="0" placeholder="0"
                value="0">
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label for="txtdescuento">*Descuento:</label>
                <input type="number" class="form-control" id="txtdescuento" name="txtdescuento" min="0" placeholder="0"
                value="0">
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label for="cboestado">*Estado:</label>
                <select id="cboestado" name="cboestado" class="form-control" required="">
                  <option value="1">Activado</option>
                  <option value="2">Desactivado</option>
                </select>
              </div>
            </div>
          </div>

          <!--          <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="txtfoto">Foto:</label>
                                <input id="txtfoto" name="txtfoto" type="file"
                                    class="form-control-file form-control height-auto">
                            </div>
                        </div>
                      </div> -->


                      <div class="modal-footer justify-content-between">
                        <button id="btnCerrar" type="button" class="btn btn-secondary" data-dismiss="modal">
                          <i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary" id="btnActionForm">
                          <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText"> Guardar</span>
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>


  <div class="modal fade" id="modalImgProducto" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header">
                <h5 id="ModalTitulo" class="modal-title">Galeria de producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
              <div class="form-group col-md-6 col-sm-12"> 
                <button id="btnImagenProducto" type="button" class="btn btn-outline-primary">
                  <i class="icon-copy fa fa-plus"></i>
                </button>
              </div>

                <div class="gallery-wrap">
                    <ul id="containerImages" class="row">
                        <li  id="div24" class="col-lg-4 col-md-6 col-sm-12">
                            <div class="da-card box-shadow">
                                <div class="da-card-photo">
                                  <div class="">
                                    <img src="<?= media(); ?>/vendors/images/product-img1.jpg" alt="" />
                                    </div>
                                    <div class="da-overlay">
                                        <div class="da-social">
<!--                                             <h5 class="mb-10 color-white pd-20">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing.
                                            </h5> -->
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
                            </div>
                        </li>
                        
<!--                         <li class="col-lg-4 col-md-6 col-sm-12">
                            <div class="da-card box-shadow">
                                <div class="da-card-photo">
                                    <img src="<?= media(); ?>/vendors/images/producto/producto-default.png" alt=""/>
                                    <div class="da-overlay">
                                        <div class="da-social">
                                            <h5 class="text-center mb-10 color-white pd-20">Agregar imagen</h5>
                                            <ul class="clearfix">
                                                <li>
                                                  <a href="#" name="foto" id="img1">
                                                  <i class="icon-copy fa fa-upload" aria-hidden="true"></i></a>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </div>

            <div class="modal-footer">
                <button id="btnCerrar" type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-fw fa-lg fa-times-circle"></i> Cerrar
                </button>
            </div>

        </div>
    </div>
</div>

          <!-- <div class="modal fade" id="modalViewProducto" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content border-0">
                <div class="modal-header">
                  <h5 id="ModalTitulo" class="modal-title">Datos del Producto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="profile-photo">
                    <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <img src="<?= media(); ?>/vendors/images/photo1.jpg" alt="" class="avatar-photo" />
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-body pd-5">
                          <div class="img-container">
                            <img id="image" src="<?= media(); ?>/vendors/images/photo2.jpg" alt="Picture" />
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" value="Update" class="btn btn-primary" />
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <h5 class="text-center h5 mb-0" id="viewName">Unknown</h5>
                <p class="text-center text-muted font-14" id="viewRol">Cargando...</p>
                <h5 class="mb-20 h5 text-center text-blue">Información del contacto</h5>
                <div class="profile-info">
                  <table class="table table-sm table-bordered">
                    <tbody>
                      <tr>
                        <td>Nombre de Producto:</td>
                        <td id="viewUser">name_user15</td>
                      </tr>
                      <tr>
                        <td>correo electronico:</td>
                        <td id="viewCorreo">name@gmail.com</td>
                      </tr>
                      <tr>
                        <td>DNI:</td>
                        <td id="viewDNI">710892536</td>
                      </tr>
                      <tr>
                        <td>Celular:</td>
                        <td id="viewCel">999-999-999</td>
                      </tr>
                      <tr>
                        <td>Fecha de nacimiento:</td>
                        <td id="ViewFech">01/02/2000</td>
                      </tr>
                      <tr>
                        <td>Género:</td>
                        <td id="viewGenero">No defenido</td>
                      </tr>
                      <tr>
                        <td>Estado:</td>
                        <td id="viewEstado">No defenido</td>
                      </tr>
                      <tr>
                        <td>Ultima vez accedido:</td>
                        <td id="viewUltim">Verificando...</td>
                      </tr>
                      <tr>
                        <td>Fecha registro:</td>
                        <td id="viewRegis">01/01/2022</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="modal-footer">
                <button id="btnCerrar" type="button" class="btn btn-secondary" data-dismiss="modal">
                  <i class="fa fa-fw fa-lg fa-times-circle"></i> Cerrar
                </button>
              </div>
            </div>
          </div>
        </div> -->
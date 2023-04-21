<div class="modal fade" id="modalFormProveedor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="modal-header">
        <h5 id="ModalTitulo" class="modal-title">Registro de Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formProveedor" name="formProveedor" autocomplete="off">
          <input type="hidden" id="txtidproveedor" name="txtidproveedor" value="">
          <input type="hidden" id="foto_actual" name="foto_actual" value="">
          <input type="hidden" id="foto_remove" name="foto_remove" value="0">
          <p class="text-primary">Todos los campos son obligatorio (*).</p>

          <div class="row">
            <div class="col-md-8 col-sm-12">
              <div class="form-group">
                <label for="txtrazons">*Razón social:</label>
                <input type="text" class="form-control" id="txtrazons" name="txtrazons" placeholder="Escriba el nombre de la razón social" required="">
              </div>
              <div class="form-group">
                <label for="txtnomcom">*Nombre comercial:</label>
                <input type="text" class="form-control" id="txtnomcom" name="txtnomcom" placeholder="Escriba el nombre comercial" required="">
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtfoto">Logo: (256x256)</label>
                <div class="prevPhotoProv">
                  <span id="xfoto" class="delPhoto notblock">X</span>
                  <label for="txtfoto"></label>
                  <div>
                    <img id="img" src="<?= media(); ?>/vendors/images/empresa/imagen-default.jpg">
                  </div>
                </div>
                <div class="upimg">
                  <input accept="image/png,image/jpeg" type="file" name="txtfoto" id="txtfoto">
                </div>
                <div id="form_alert"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtruc">*RUC:</label>
                <input type="text" class="form-control valid validNumber" id="txtruc" name="txtruc" placeholder="Escriba su RUC" maxlength="20" onkeypress="return controlTag(event);">
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtmovil">Móvil:</label>
                <input type="tel" class="form-control valid validNumber" id="txtmovil" name="txtmovil" placeholder="Escriba su número móvil" maxlength="9" onkeypress="return controlTag(event);">
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtfijo">Fijo:</label>
                <input type="tel" class="form-control valid validNumber" id="txtfijo" name="txtfijo" placeholder="Escriba su número fijo" maxlength="9" onkeypress="return controlTag(event);">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label for="txtdirec">Dirección:</label>
                <input type="text" class="form-control" id="txtdirec" name="txtdirec" placeholder="Av.">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 col-sm-12">
              <div class="form-group">
                <label for="txtcorreo">Correo:</label>
                <input type="email" class="form-control valid validEmail" id="txtcorreo" name="txtcorreo" placeholder="example@gmail.com">
              </div>
            </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label for="cboestado">*Estado:</label>
                  <select id="cboestado" name="cboestado" class="form-control" required="">
                    <option value="1">Activo</option>
                    <option value="0">Desactivado</option>
                  </select>
                </div>
              </div>
          </div>

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

  <div class="modal fade" id="modalViewProveedor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content border-0">
        <div class="modal-header">
          <h5 id="ModalTitulo" class="modal-title">Datos del Proveedor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="viewImagen" class="profile-photo">
            <!-- <img src="<?= media(); ?>/vendors/images/photo1.jpg"alt=""class="avatar-photo"/> -->
          </div>

          <h5 class="text-center h5 mb-0" id="viewRazons">Unknown</h5>
          <p class="text-center text-muted font-14" id="viewId">Cargando...</p>
          <h5 class="mb-20 h5 text-center text-blue">Información de la empresa</h5>
          <div class="profile-info">
            <table class="table table-sm table-bordered">
              <tbody>
                <tr>
                  <td>Nombre comercial:</td>
                  <td id="viewNom">Unknown</td>
                </tr>        
                <tr>
                  <td>RUC:</td>
                  <td id="viewRUC">710892536</td>
                </tr>        <tr>
                <tr>
                  <td>correo electronico:</td>
                  <td id="viewCorreo">name@gmail.com</td>
                </tr>
                  <td>N° Móvil:</td>
                  <td id="viewMov">999-999-999</td>
                </tr>
                <tr>
                  <td>N° Fijo:</td>
                  <td id="ViewFijo">000-000-000</td>
                </tr>        
                <tr>
                  <td>Dirección:</td>
                  <td id="viewDirec">No defenido</td>
                </tr>
                <tr>
                  <td>Estado:</td>
                  <td id="viewEstado">No defenido</td>
                </tr>
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
  </div>

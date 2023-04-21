<div class="modal fade" id="modalFormCliente" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="modal-header">
        <h5 id="ModalTitulo" class="modal-title">Registro de Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCliente" name="formCliente" autocomplete="off">
          <input type="hidden" id="txtidcliente" name="txtidcliente" value="">
          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorio.</p>

          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label for="txtnom">*Nombre Cliente/Empresa:</label>
                <input type="text" class="form-control" id="txtnom" name="txtnom" placeholder="Escriba sus nombres" required="">
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="txtdni">DNI:</label>
                <input type="text" class="form-control valid validNumber" id="txtdni" name="txtdni" placeholder="Ej. 70894568" maxlength="8" onkeypress="return controlTag(event);">
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="txtruc">RUC:</label>
                <input type="text" class="form-control valid validNumber" id="txtruc" name="txtruc" placeholder="Ej. 1071089253" maxlength="8" onkeypress="return controlTag(event);">
              </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label for="txtcorreo">Correo:</label>
                <input type="email" class="form-control valid validEmail" id="txtcorreo" name="txtcorreo" placeholder="example@gmail.com">
              </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label for="txtdirec">Dirección:</label>
                <input type="text" class="form-control" id="txtdirec" name="txtdirec" placeholder="Escriba su dirección" >
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="txtcel">Celular:</label>
                <input type="tel" class="form-control valid validNumber" id="txtcel" name="txtcel" placeholder="999-999-999" maxlength="9" onkeypress="return controlTag(event);">
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="cboestado">*Estado:</label>
                <select id="cboestado" name="cboestado" class="form-control" required="">
                  <option value="1">Activo</option>
                  <option value="0">Desactivado</option>
                </select>
              </div>
            </div>

          </div>

<!--             <div class="row"> 
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Foto:</label>
                  <input type="file" class="form-control-file form-control height-auto">
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

  <div class="modal fade" id="modalViewCliente" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content border-0">
        <div class="modal-header">
          <h5 id="ModalTitulo" class="modal-title">Datos del Cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="profile-photo">
            <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar" >
              <i class="fa fa-pencil"></i>
            </a>
            <img src="<?= media(); ?>/vendors/images/photo1.jpg"alt=""class="avatar-photo"/>
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body pd-5">
                    <div class="img-container">
                      <img id="image" src="<?= media(); ?>/vendors/images/photo2.jpg" alt="Picture"/>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" value="Update" class="btn btn-primary"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h5 class="text-center h5 mb-0" id="viewName">Unknown</h5>
          <p class="text-center text-muted font-14">Cliente</p>
          <h5 class="mb-20 h5 text-center text-blue">Información del contacto</h5>
          <div class="profile-info">
            <table class="table table-sm table-bordered">
              <tbody>
                <tr>
                  <td>DNI:</td>
                  <td id="viewDNI">710892536</td>
                </tr>  
                <tr>
                  <td>RUC:</td>
                  <td id="viewRUC">710892536</td>  
                </tr>      
                <tr>
                  <td>Celular:</td>
                  <td id="viewCel">999-999-999</td>
                </tr>       
                <tr>
                  <td>Correo:</td>
                  <td id="viewCorreo">name@gmail.com</td>
                </tr>
                <tr>
                  <td>Dirección:</td>
                  <td id="viewDirec">name@gmail.com</td>
                </tr>
                <tr>
                  <td>Estado:</td>
                  <td id="viewEstado">No defenido</td>
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
  </div>

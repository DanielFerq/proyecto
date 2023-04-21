<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="modal-header">
        <h5 id="ModalTitulo" class="modal-title">Registro de Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" name="formUsuario" autocomplete="off">
          <input type="hidden" id="txtidusuario" name="txtidusuario" value="">
          <input type="hidden" id="foto_actual" name="foto_actual" value="">
          <input type="hidden" id="foto_remove" name="foto_remove" value="0">
          <p class="text-primary">Todos los campos son obligatorio (*).</p>

          <div class="row">
            <div class="col-md-8 col-sm-12">
              <div class="form-group">
                <label for="txtnom">*Nombres:</label>
                <input type="text" class="form-control valid validText" id="txtnom" name="txtnom" placeholder="Escriba sus nombres" required="">
              </div>
              <div class="form-group">
                <label for="txtapell">*Apellidos:</label>
                <input type="text" class="form-control valid validText" id="txtapell" name="txtapell" placeholder="Escriba sus apellidos" required="">
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtfoto">Foto: (256x256)</label>
                <div class="prevPhoto">
                  <span id="xfoto" class="delPhoto notblock">X</span>
                  <label for="txtfoto"></label>
                  <div>
                    <img id="img" src="<?= media(); ?>/vendors/images/usuario/user-default.png">
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
                <label for="txtdni">*DNI:</label>
                <input type="text" class="form-control valid validNumber" id="txtdni" name="txtdni" placeholder="Escriba su DNI de indenficación" maxlength="8" onkeypress="return controlTag(event);">
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtfechanac">Fecha de nacimiento:</label> 
                <input type="date" class="form-control" id="txtfechanac" name="txtfechanac" placeholder="dd/mm/yyyy" value="2000-01-01" >
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtcel">Celular:</label>
                <input type="tel" class="form-control valid validNumber" id="txtcel" name="txtcel" placeholder="Escriba sus número de celular" maxlength="9" onkeypress="return controlTag(event);">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="txtcorreo">*Correo:</label>
                <input type="email" class="form-control valid validEmail" id="txtcorreo" name="txtcorreo" placeholder="example@gmail.com">
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="form-group">
                <label for="cborol">*Rol:</label>
                <select id="cborol" data-live-search="true" name="cborol" class="form-control" required="">
                  <!-- <option value="1">Admin</option>
                    <option value="0">Vendedor</option> -->
                  </select>
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


<!--             <div class="row"> 
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Foto:</label>
                  <input type="file" class="form-control-file form-control height-auto">
                </div>
              </div>
            </div> -->

            <p class="text-primary">Acceso</p>

            <div class="row">
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label for="txtuser">*Usuario:</label>
                  <input type="text" class="form-control" id="txtuser" name="txtuser" placeholder="Escriba su nombre de usuario" >
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label for="txtclave">*Contraseña:</label>
                  <input type="password" class="form-control" id="txtclave" name="txtclave" placeholder="Escriba su contraseña" autocomplete="new-password">
                </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                  <label for="txtclave2">*Repetir contraseña:</label>
                  <input type="password" class="form-control" id="txtclave2" name="txtclave2" placeholder="Repite la contraseña" autocomplete="new-password">
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

  <div class="modal fade" id="modalViewUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content border-0">
        <div class="modal-header">
          <h5 id="ModalTitulo" class="modal-title">Datos del Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="viewImagen" class="profile-photo">
            <!-- <img src="<?= media(); ?>/vendors/images/photo1.jpg"alt=""class="avatar-photo"/> -->
          </div>

          <h5 class="text-center h5 mb-0" id="viewName">Unknown</h5>
          <p class="text-center text-muted font-14" id="viewRol">Cargando...</p>
          <h5 class="mb-20 h5 text-center text-blue">Información del contacto</h5>
          <div class="profile-info">
            <table class="table table-sm table-bordered">
              <tbody>
                <tr>
                  <td>Nombre de usuario:</td>
                  <td id="viewUser">name_user15</td>
                </tr>        
                <tr>
                  <td>correo electronico:</td>
                  <td id="viewCorreo">name@gmail.com</td>
                </tr>
                <tr>
                  <td>DNI:</td>
                  <td id="viewDNI">710892536</td>
                </tr>        <tr>
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
                </tr>        <tr>
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

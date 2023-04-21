<div class="modal fade" id="modalPermiso" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="myExtraLargeModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Permisos Roles de Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="formPermiso" name="formPermiso">
        <div class="modal-body">
          <?php 
        //dep($data);
          ?>
          <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?>" required="">
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead>
                <tr class="text-center thead-dark">
                  <th style="width: 10px">#</th>
                  <th>Módulos</th>
                  <th>Ver</th>
                  <th>Crear</th>
                  <th>Actualizar</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody>

                <?php 

                $n=1;
                $modulos = $data['modulos'];
                for ($i=0; $i < count($modulos); $i++) { 

                  $permisos = $modulos[$i]['permisos'];
                  $rCheck = $permisos['r'] == 1 ? " checked " : "";
                  $wCheck = $permisos['w'] == 1 ? " checked " : "";
                  $uCheck = $permisos['u'] == 1 ? " checked " : "";
                  $dCheck = $permisos['d'] == 1 ? " checked " : "";

                  $idmod = $modulos[$i]['idmodulo'];
                  ?>
                  <tr>
                    <td>
                      <?= $n; ?>
                      <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" required>
                    </td>
                    <td class="text-left"><?= $modulos[$i]['nombremodulo'] ?></td>

                    <td>
                      <input type="checkbox" class="js-switch" id="modulos[<?= $i; ?>][r]" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?> />
                    </td>
                    <td>
                      <input type="checkbox" class="js-switch" id="modulos[<?= $i; ?>][w]"  name="modulos[<?= $i; ?>][w]" <?= $wCheck ?> />
                    </td>
                    <td>
                      <input type="checkbox" class="js-switch" id="modulos[<?= $i; ?>][u]"  name="modulos[<?= $i; ?>][u]" <?= $uCheck ?> />
                    </td>
                    <td>
                      <input type="checkbox" class="js-switch" id="modulos[<?= $i; ?>][d]"  name="modulos[<?= $i; ?>][d]" <?= $dCheck ?> />
                    </td>
                  </tr>

                  <?php 
                  $n++;
                }
                ?>
              </tbody>
            </table>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button id="btnCancelarPerm" type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fa fa-fw fa-lg fa-times-circle"></i> Cancelar
          </button>
          <button type="submit" class="btn btn-primary" id="btnActionFormPerm">
            <i class="fa fa-fw fa-lg fa-check-circle" aria-hidden="true"></i><span id=""> Guardar</span>
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
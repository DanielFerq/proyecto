<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modulo de Producto</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item"><a href="#">Productos</a></li>
              <li class="breadcrumb-item active">Agregar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card card-dark">

        <div class="card-header">
          <h3 class="card-title">
            <i class="nav-icon fas fa-barcode"> </i>
            Código de barra & SKU
          </h3>
        </div>

        <div class="card-body">
          <form enctype="multipart/form-data" id="formulario" method="POST" autocomplete="off">
            <div class="form-group row">
              <div class="col-6">
                <label for="">Código de barra:</label>
                <input type="text" class="form-control" placeholder="Ejem. 145682432.">
              </div>
              <div class="col-6">
                <label for="">SKU:</label>
                <input type="text" class="form-control" placeholder="Ejem. RM034-LPS">
              </div>
            </div>
          </form>
        </div>

        <div class="card-header">
          <h3 class="card-title">
            <i class="nav-icon fas fa-info"> </i>
            Información del producto
          </h3>
        </div>

        <div class="card-body">
          <form enctype="multipart/form-data" id="formulario" method="POST" autocomplete="off">
            <div class="form-group">
              <label for="txtnom">Nombre:</label>
              <input type="text" id="txtnom" name="txtnom" class="form-control" maxlength="100" />
            </div>
            <div class="form-group row">
              <div class="col-6">
                <label for="">Precio Compra:</label>
                <input type="text" class="form-control" placeholder="s/.">
              </div>
              <div class="col-6">
                <label for="">Precio Venta:</label>
                <input type="text" class="form-control" placeholder="s/.">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-4">
                <label for="">Stock:</label>
                <input type="number" class="form-control" min="1" placeholder="1-10" value="0">
              </div>
              <div class="col-4">
                <label for="">Stock Min:</label>
                <input type="number" class="form-control" min="0" placeholder="0" value="0" >
              </div>
              <div class="col-4">
                <label for="">Descuento:</label>
                <input type="number" class="form-control" min="0"placeholder="0" value="0">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-6">
                <label for="cbogen">Marca:</label>
                <select id="cbogen" name="cbogen" class="form-control">
                  <option>Seleccionar</option>
                  <option value="F">1.- Nikes</option>
                  <option value="D">2.- Gaming Load</option>
                </select>
              </div>
              <div class="form-group col-6">
                <label for="">Modelo:</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
          </form>
        </div>

        <div class="card-header">
          <h3 class="card-title">
            <i class="nav-icon fas fa-th-large"> </i>
            Tipo, Presentación, Categoría & Estado
          </h3>
        </div>
        <div class="card-body">
          <form enctype="multipart/form-data" id="formulario" method="POST" autocomplete="off">
            <div class="row">
              <div class="form-group col-6">
                <label for="cbogen">Tipo de producto:</label>
                <select id="cbogen" name="cbogen" class="form-control">
                  <option>Seleccionar</option>
                  <option value="F">1.- Físico</option>
                  <option value="D">2.- Digital</option>
                </select>
              </div>
              <div class="form-group col-6">
                <label for="cbogen">Presentación de producto:</label>
                <select id="cbogen" name="cbogen" class="form-control">
                  <option>Seleccionar</option>
                  <option value="1">1.- Unidad</option>
                  <option value="2">2.- Libra</option>
                  <option value="3">3.- Kilogramo</option>
                  <option value="4">4.- Caja</option>
                  <option value="5">5.- Paquete</option>
                  <option value="6">6.- Lata</option>
                  <option value="7">7.- Galon</option>
                  <option value="8">8.- Botella</option>
                  <option value="9">9.- Tira</option>
                  <option value="10">10.- Sobre</option>
                  <option value="11">11.- Bolsa</option>
                  <option value="12">12.- Saco</option>
                  <option value="13">13.- Tarjeta</option>
                  <option value="14">14.- Otro</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-6">
                <label for="cbogen">Categoría de producto:</label>
                <select id="cbogen" name="cbogen" class="form-control">
                  <option>Seleccionar</option>
                  <option value="F">1.- Video juegos</option>
                  <option value="D">2.- PC Gaming</option>
                </select>
              </div>
              <div class="form-group col-6">
                <label for="cbogen">Estado de producto:</label>
                <select id="cbogen" name="cbogen" class="form-control">
                  <option>Seleccionar</option>
                  <option value="A">1.- Activo</option>
                  <option value="D">2.- Desactivado</option>
                </select>
              </div>
            </div>
          </form>
        </div>

        <div class="card-header">
          <h3 class="card-title">
            <i class="nav-icon fas fa-comment"> </i>
            Descripción
          </h3>
        </div>
        <div class="card-body">
            <div class="form-group">
              <textarea id="summernote" class="form-control" id="message-text"></textarea>
            </div> 
        </div>

        <div class="card-header">
          <h3 class="card-title">
            <i class="nav-icon fas fa-image"></i>
            Foto o portada de producto
          </h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <p>Tipos de archivos permitidos: JPG, JPEG, PNG Tamaño máximo 3MB.</p>
            <p>Resolución recomendada 500px X 500px o superior manteniendo el aspecto cuadrado (1:1).</p>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="txtimg">
              <label class="custom-file-label" for="txtimg">Elegir archivo</label>
            </div>
          </div>
        </div>
      </div>

        <!-- /.card-body -->
        <div class="card-footer">
          <button id="btnRegistrar" type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i>
          Guardar
        </button>
          <button type="reset" id="btnCancelar" class="btn btn-default float-right" style="margin-right: 5px;"><i class="fas fa-window-close"></i>
            Cancelar
          </button>
        </div>
      </div>

    </section>
</div>

    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="#" class="h1"><b>Admin-</b>System</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Ingrese su cuenta para iniciar la sesión</p>

          <form method="post" id="formulario">
            
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="ID" id="ingUsuario" name="ingUsuario" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Contraseña" id="ingClave" name="ingClave" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Recuérdame
                  </label>
                </div>
              </div>

              <div class="col-4">
                <input type="submit" value="Iniciar" id="btnIniciar" class="btn btn-primary btn-block"></input>
              </div>

            </div>
          </form>

        </div>
      </div>
    </div>

    <?php 

/*     if(isset($_POST['ingUsuario'])){
        echo " se envio: " . $_POST['ingUsuario'];
        echo " se envio: " . $_POST['ingClave'];
     }*/

     ?>

  <script src="views/jquery/jquery.min.js"></script>
  <script src="views/bootstrap/js/bootstrap.min.js"></script> 

  <script>
    $(document).ready(function(){
      
     $("#formulario").on("submit", function(e){
        e.preventDefault();

        $.ajax({
          url: '../../controllers/usuario.controller.php',
          //url: 'modulos/prueba.php',
          type: 'POST',
          dataType: 'html',
          data: 'operacion=login',
        })
        .done(function() {
          alert(data);
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
        

       /* $.ajax({
          //url:'views/controllers/usuario.controlador.php',
          url: '../controllers/usuario.controller.php';
          type:'POST',
          datatype:'html',
          data:datosFormulario,
          cache:false,
          contentType:false,
          processData:false

        })
        .done(function(res){
          alert(res);
          alert("Enviado");
          //alert("Hola");
          //$("#formulario")[0].reset();
        });*/

      });

    });
  </script> 
	<!-- Modal body -->
    <div class="modal-body">
		<h5>Formulario de inicio de sesión</h5>
		<hr>
		<form action="" method="post">
			<div class="form-group has-danger">
			  <label class="form-label" for="username" id="label_username">Correo o nombre de usuario</label>
			  <input type="text" class="form-control" id="username" name="username">
			</div>
			<div class="form-group">
			  <label for="pwd" class="form-label" id="label_password">Contraseña</label>
			  <input type="password" class="form-control" id="password" name="pswd">
			</div>
			<div class="form-group form-check">
			  <label class="form-check-label">
				<input class="form-check-input" type="checkbox" name="remember" id="remember"> No cerrar sesión
			  </label>
			</div>
		  	<!--Mensaje de error-->
			<div class="alert alert-danger" id="msg_error" style="display: none">
				<strong>¡Ups!</strong> <span id="span_error"></span></a>
			</div>
			<!--Mensaje de éxito-->
			<div class="alert alert-success" id="msg_success" style="display: none">
				<strong>¡Bien!</strong> <span id="span_success"></span></a>
			</div>
			<span class="btn btn-primary" id="login-button">Aceptar</span>
		  </form>
	</div>
	
	<!-- Modal footer -->
      <div class="modal-footer" style="display: block">
       	<p><a href="user.php?action=register">¿No estás registrado?</a> - <a href="user.php?action=rememberPass">¿Olvidaste tu contraseña?</a></p>
        <!--<button type="button" class="btn btn-danger" data-dismiss="modal"><Cerrar></Cerrar></button>-->
      </div>
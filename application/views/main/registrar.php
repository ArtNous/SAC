<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Registro de usuario | Sistema de atención al cliente</title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.min.css'); ?>">
		<link rel="stylesheet" href="">
		<style>
			body {
				/*background-color: #06BED5;*/
				background-color: #102F5B;
			}
			.container{
				margin: 10px auto;
			}

			h3.center{
				color: white;
			}
			form {
				background-color: white;
				padding: 35px 20px;
				box-shadow: 0 0 40px rgba(0,0,0,0.45);
				width: 35%;
				margin: auto;
			}
			button[type='submit'] {
				display: block;
				width: 100%;
			}
		</style>
	</head>
	<body>
		<div class="container">
		<div class="row">
			<div class="col s12 m12 l12">
				<h3 class="center">Sistema de atención al cliente</h3>
			</div>
		</div>
			<div class="row center">
				<?php
					$atributos = array(
						'id' => 'login',
					);
				?>
				<?php echo form_open('auth/validacion_reg/',$atributos); ?>
				<p class="center"><i class="material-icons large" style="color: #102F5B">settings</i></p>
				<p class="center"><?php echo $titulo; ?></p>
				<div class="input-field">
					<i class="material-icons prefix">account_circle</i>
					<label for="txtCedula">Cédula</label>
					<input type="text" class="form-control" id="txtCedula" name="cedula">
					<span class="error-form"><?php echo form_error('cedula') ?></span>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">perm_identity</i>
					<label for="txtUsuario">Nombre de usuario</label>
					<input type="text" class="form-control" id="txtUsuario" name="usuario">
				</div>
				<div class="input-field">
					<i class="material-icons prefix">email</i>
					<label for="txtEmail">Correo electrónico</label>
					<input type="text" class="form-control" id="txtEmail" name="email">
				</div>
				<div class="input-field">
					<i class="material-icons prefix">https</i>
					<label for="txtPass">Contraseña</label>
					<input type="password" class="form-control" id="txtPass" name="pass">
					<span class="error-form"><?php echo form_error('pass') ?></span>
				</div>
				<div class="input-field">
					<select name="rol" id="select-rol">
						<option value="" disabled selected>Seleccione el rol</option>
						<option value="1">Administrador</option>
						<option value="2">Operador</option>
					</select>
					<label for="select-rol">Rol de usuario</label>
				</div>
				<button type="submit" class="btn">Registrar</button>
				
			</form>
		</div>
	</div>
	<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/materialize.min.js'); ?>"></script>
	<script>
		$('#select-rol').material_select();
	</script>
</body>
</html>
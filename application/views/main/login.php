<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Ingreso al sistema | Sistema de atencion al cliente</title>
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
			.msj-login{
				color: white;
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
				<?php echo form_open('auth/validacion',$atributos); ?>
				<p class="center"><i class="material-icons large" style="color: #102F5B">settings</i></p>
				<p class="center"><?php echo $titulo; ?></p>
				<div class="input-field">
					<i class="material-icons prefix">account_circle</i>
					<label for="txtUsuario">Usuario</label>
					<input type="text" class="form-control" id="txtUsuario" name="usuario">
				</div>
				<div class="input-field">
					<i class="material-icons prefix">https</i>
					<label for="txtPass">Contraseña</label>
					<input type="password" class="form-control" id="txtPass" name="pass">
				</div>
				<p>
					<input type="checkbox" id="recordar" name="recordar" />
					<label for="recordar">Recordarme</label>
				</p>
				<button type="submit" class="btn">Entrar</button>
				<p>
					<a href="<?php echo base_url('auth/registrar'); ?>" style="float: left">Registrarse</a>
					<a href="#!" style="float: right">Olvide la clave</a>
				</p>
				<div class="error">
					<?php echo validation_errors(); ?>
					<?php echo $this->session->flashdata('error'); ?>
				</div>
			</form>
			<div class="msj-login center">
				<h4><?php 
				if(isset($msj)){
					echo $msj;
				}
			?></h4>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/materialize.min.js'); ?>"></script>
</body>
</html>
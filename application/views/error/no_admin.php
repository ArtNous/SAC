<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Módulo de atención</title>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/estilos.css'); ?>">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/dragula.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/configuracion/estilo.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/webix/webix.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/webix/skins/air.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/sweetalert2.min.css'); ?>">
		<style>
			.container a {
				display: block;
				width: 200px;
				margin: 0 auto;
			}
		</style>
	</head>
	<body>

		<header>
			<nav id="barra-principal">
				<img src="<?php echo base_url('assets/img/logogrupoavenida.png'); ?>" alt="logo" id="logoCA" width="200px">
				<div class="nav-wrapper">
					<a href="#" class="brand-logo center btnColapsableMenu" data-activates="slide-out">SAC</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
					</ul>
				</div>
			</nav>
		</header>

		<div class="container">
			<div class="row">
				<div class="col s12 m12 l12">
					<h1 class="center">Oh!...</h1>
					<h4 class="center">Parece que no eres el administrador y no puedes ingresar a esta sección.</h4>
					<a href="<?php echo base_url('orden/crear'); ?>" class="btn">Menu Principal</a>
				</div>
			</div>
		</div>

		</main>
		<footer>
			
		</footer>
	</body>
</html>
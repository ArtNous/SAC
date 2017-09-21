<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Caucho Avenida | Módulo de servicios</title>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/materialize.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/estilos.css'); ?>">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<style>
			body{
				background-color: #CCC;
			}
			.card{
				overflow: hidden;
			}
			.card-hidden{
				position: absolute;
				bottom: 0;
				top: 100%;
				padding: 4px 10px;
				margin: 0;
				background-color: white;
			}
			#barra-secundaria {
				margin-top: 10px;
				background-color: blue;
			}

			.titulo-opcion{
				color: white;
			}

			.side-nav{
				background-color: #CCC;
			}

		</style>
	</head>
	<body>
		<header>
			<nav id="barra-principal">
				<div class="nav-wrapper">
					<a href="#" class="brand-logo center btnColapsableMenu" data-activates="slide-out">CAvenida</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<!-- <li><a href="sass.html">Sass</a></li> -->
						<!-- <li><a href="badges.html">Components</a></li> -->
						<!-- <li><a href="collapsible.html">JavaScript</a></li> -->
					</ul>
				</div>
			</nav>
		</header>
		<main>
			<!-- Barra de herramienta -->
			<ul id="dropdown1" class="dropdown-content">
				<li><a href="#!">Ver todos</a></li>
				<li><a href="#!">Agregar</a></li>
				<li class="divider"></li>
				<li><a href="#!">Crear orden</a></li>
			</ul>
			<ul id="dropdown2" class="dropdown-content">
				<li><a href="#!">Ver</a></li>
				<li><a href="#!">Crear servicio</a></li>
				<li class="divider"></li>
				<li><a href="#!">Crear orden</a></li>
			</ul>
			<ul id="dropdown3" class="dropdown-content">
				<li><a href="#!">Crear marca</a></li>
				<li><a href="#!">Crear modelo</a></li>
				<li class="divider"></li>
				<li><a href="#!">Crear tipo de vehiculo</a></li>
			</ul>
			<nav id="barra-secundaria" class="container-fluid">
				<div class="nav-wrapper left">
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a class="dropdown-button" data-activates="dropdown1" href="#!">Clientes<i class="material-icons right">face</i></a></li>
						<li><a class="dropdown-button" data-activates="dropdown2" href="#!">Servicios<i class="material-icons right">apps</i></a></li>
						<li><a class="dropdown-button" data-activates="dropdown3" href="#!">Configuración<i class="material-icons right">build</i></a></li>
						<li><a href="#!">Resumen</a></li>
					</ul>
				</div>
			</nav>
			<!-- ./ -->
			<aside>
				<ul id="slide-out" class="side-nav">
					<li><div class="user-view">
						<div class="background">
							<img src="">
						</div>
						<a href="#!user"><img class="circle" src="<?php echo base_url('assets/img/avatar_hombre.png');?>"></a>
						<a href="#!name"><span class="white-text name">Jesus Pacheco</span></a>
						<a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
					</div></li>
					<li><a href="#!"><i class="material-icons">description</i>Reportes</a></li>
					<!-- <li><a href="#!">Second Link</a></li> -->
					<li><div class="divider"></div></li>
					<li><a class="subheader">Ayuda</a></li>
					<li><a class="waves-effect" href="#!">Manual</a></li>
				</ul>
			</aside>
			<!-- Boton para acciones rapidas -->
			<div class="fixed-action-btn">
				<a class="btn-floating btn-large red">
					<i class="large material-icons">menu</i>
				</a>
				<ul>
					<!-- <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li> -->
					<!-- <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li> -->
					<li><a class="btn-floating green"><i class="material-icons">equalizer</i></a></li>
					<li><a class="btn-floating blue"><i class="material-icons">content_paste</i></a></li>
				</ul>
			</div>
			<!-- ./ -->

			<!-- Sección principal -->
			<div class="container-fluid">
				<div class="row">
					<h3 class="center">Módulo de atención al cliente</h3>
					<div class="col s12 m4">
					<!-- Boton grande de opción -->
						<div class="card-panel blue center">
							<h3 class="titulo-opcion"><i class="material-icons large">face</i></h3>
							<a class="waves-effect waves-light btn-large red" href="<?php echo base_url('index.php/clientes'); ?>">Clientes</a>
						</div>
						<!-- ./ -->
					</div>
					<div class="col s12 m4">
						<div class="card-panel orange center">
							<h3 class="titulo-opcion"><i class="material-icons large">apps</i></h3>
							<a class="waves-effect waves-light btn-large red" href="<?php echo base_url('index.php/servicios'); ?>">Servicios</a>
						</div>
					</div>
					<div class="col s12 m4">
						<div class="card-panel green center">
							<h3 class="titulo-opcion"><i class="material-icons large">build</i></h3>
							<a class="waves-effect waves-light btn-large red" href="<?php echo base_url('index.php/configuracion'); ?>">Configuración</a>
						</div>
					</div>
				</div>
			</div>
			<!-- ./ -->
		</main>
		<footer>
			
		</footer>
		<script src="<?php echo base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/materialize.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/angular.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/confUI.js'); ?>"></script>
		<script>
			$('.btnAbrirCarta').click(function(){
				var tarjeta = $(this).closest('.card').find('.card-hidden');
				if($(tarjeta).css('top') == '0px'){
					$(tarjeta).animate({
						top: "100%"
					},500);
				} else {
					$(tarjeta).animate({
						top: "0"
					},500);
				}
			});
		</script>
	</body>
</html>
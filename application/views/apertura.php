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
			/*Lista de ordenes - Botones*/
			.btnToolbar button {
				color: black;
			}
			/*Formularios*/
			.error_form{
				padding: 8px;
				/*background-color: red;*/
				border-radius: 6px;
				margin: 4px 0;
				color: red;
			}
			.campoOrden{
				position: relative;
			}

			.error_form_orden{
				position: absolute;
				right: 100%;
				width: 150px;
				padding: 5px;
				text-align: center;
				color: red;
			}

			.error_form_orden::after{
				content: '=>';
				position: absolute;
				right: -5%;
				top: 20%;
			}

			form .campoOrden:last-child .error_form_orden{
				left: 10%;
				top: 70%;
				width: 250px;
			}
			form .campoOrden:last-child .error_form_orden::after{
				content: '';
			}

			/*Fin*/

			.cola-siguiente {
				background-color: lightgreen;
			}
			.cola-posteriores {
				background-color: red;
			}
			span.info{
				float: right;
				background-color: #143568;
				color: white;
				padding: 1px 5px;
				vertical-align: middle;
				border-radius: 4px;
				text-align: center;
			}
			button.finalizarOrden {
				float: right;
				position: absolute;
				right: 15%;
				top: 50%;
			}
			a.details_button{
				float: right;
				color: black;
				background-color: white;
				padding: 0px 8px;
				border-radius: 3px;
			}
			.tecnico-activo{
				background-color: green;
			}
			.hover{
				background-color: whie;
			}

			/*Lista de ordenes de servicios*/
			.fila-orden-activa{
				background-color: green;
			}
			.fila-orden-cola{
				background-color: orange;
			}
			.fila-orden-finalizada{
				background-color: yellow;
			}
			.fila-orden-anulada{
				background-color: brown;
			}
			.cola-suave{background-color: #889CCF; color: black;}
			.cola-mediana{background-color: #536697; color: white;}
			.cola-larga{background-color: #212F51; color: white;}
			/*GAGE de ordenes activas*/
			.porta-gage{
				background-color: #2D2A7E;
				text-align: center;
				padding: 6px 0;
			}
			.gage{
				width: 180px;
				height: 130px;
				margin: auto;
			}
			/*Ficha de orden de servicio*/
			.ficha-orden-campo{
				background-color: #0B0B61;
				color: white;
				border-radius: 5px;
				height: 70px;
				padding: 0 3px;
			}
			.ficha-orden-campo * {
				vertical-align: middle;
			}
		</style>
	</head>
	<body>
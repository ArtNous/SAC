<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Módulo de atención</title>
		<?php foreach($css as $c): ?>
			<link rel="stylesheet" href="<?php echo base_url($c); ?>">
		<?php endforeach; ?>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<style>
			@media (max-width: 1260px){
				#logoCA {
					display: none;
				}
			}
		</style>
	</style>
	</head>
	<body>
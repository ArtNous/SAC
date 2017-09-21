<div class="container">
	<!-- Lista de la cola de servicios (administrador puede alterar cola) -->
	<div class="row">
		<div class="col s12 m12 l12">
			<h3 class="center">Cola de servicios</h3>
			<div id="lista-webix"></div>
		</div>
	</div>
	<div class="row" >
		<h3 class="center">Mecánicos en ocupación</h3>
		<?php foreach($ordenes as $o): ?>
		<?php if($o['estatus'] == 1): ?>
		<div class="col s12 m12 l12 activa" id="caja_ocupacion">
		<?php elseif($o['estatus'] == 3): ?>
		<div class="col s12 m12 l12 finalizada" id="caja_ocupacion">
		<?php else: ?>
		<div class="col s12 m12 l12" id="caja_ocupacion">
		<?php endif; ?>
			<?php 
				$ahora = new DateTime();
				$inicio = new DateTime($o['fecha_inicio']);
				$porcentaje = $ahora->diff($inicio);
				// print_r($ahora);
				// print_r($inicio);
				// print_r($porcentaje);
				// $porcentaje = $ahora->diff($inicio);
			?>
			<span><?php echo $o['tecnico']; ?></span>
			<progress max="<?php echo $o['tiempo']; ?>" value="<?php echo $porcentaje->i; ?>" data-tiempo="<?php echo $o['tiempo']; ?>"></progress>
			<span><?php echo $porcentaje->i / $o['tiempo'] * 100; ?>%</span>
			<?php if ($porcentaje->i < $o['tiempo']): ?>
			<span class="center"><?php echo $o['tiempo'] - $porcentaje->i; ?> minutos para completar</span>
			<?php else: ?>
			<span class="center"><?php echo $porcentaje->i - $o['tiempo']; ?> minutos sobrepasados</span>
			<?php endif; ?>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="row">
		<div id="linea-tiempo"></div>
	</div>
</div>
<style>
	.row {
		padding: 0 100px;
	}

	#caja_ocupacion {
		margin: 2px;
		padding: 10px;
		background-color: black;
		box-shadow: 4px 3px 10px rgba(0,0,0,0.6);
		color: white;
	}

		#caja_ocupacion.activa{
			background-color: #143568;
		}

		#caja_ocupacion.activa span{
			color: white;
		}

		#caja_ocupacion.finalizada{
			background-color: blue;
		}

		#caja_ocupacion.finalizada span{
			color: white;
		}

		#caja_ocupacion progress {
			vertical-align: middle;
			margin-left: 15px;
			position: relative;
		}

		#caja_ocupacion span{
			color: white;
			vertical-align: middle;
			display: inline-block;
			width: 150px;
		}

</style>
<div class="container">
	<div class="row">
		<?php if ($orden['estatus'] == 1): ?>
		<i class="material-icons">cached</i>
		<?php else:?>
		<span class="badge estado">Pendiente</span>
		<?php endif;?>
		<span class="badge"><?php echo $orden['nro_orden']; ?></span>
		<h4 class="center"><?php echo $cliente['Nombre']; ?></h4>
		<div class="col s6 m12 l12">
			Codigo:
			<div class="input-field inline">
				<input id="first_name" type="text" class="validate" disabled>
				<label for="first_name"><?php echo $orden['cod_cliente']; ?></label>
			</div>
			Placa:
			<div class="input-field inline">
				<input id="first_name" type="text" class="validate" disabled>
				<label for="first_name"><?php echo $orden['placa']; ?></label>
			</div>
			Fecha:
			<div class="input-field inline">
				<input id="first_name" type="text" class="validate" disabled>
				<label for="first_name"><?php echo $orden['fecha']; ?></label>
			</div>
			Vendedor:
			<div class="input-field inline">
				<input id="first_name" type="text" class="validate" disabled>
				<label for="first_name"><?php echo $orden['cod_vendedor']; ?></label>
			</div>
		</div>
		<div class="col s6 m12 l12">
			Inicio en:
			<div class="input-field inline">
				<input id="first_name" type="text" class="validate" disabled>
				<label for="first_name"><?php echo $orden['fecha_inicio']; ?></label>
			</div>
		</div>
		<?php if($orden['estatus'] == 2): ?>
		<div class="col s6 m12 l12">
			Turno en la cola:
			<div class="input-field inline">
				<input id="cola" type="text" class="validate" disabled>
				<label for="cola">
					<?php echo $orden['posicion_inicial']; ?>
				</label>
			</div>
		</div>
		<?php elseif($orden['estatus'] == 1): ?> <!-- Orden activa -->
		<div class="col s6 m12 l12">
			Mecánico:
			<div class="input-field inline">
				<input id="cola" type="text" class="validate" disabled>
				<label for="cola">
					<?php echo $orden['tecnico']; ?>
				</label>
			</div>
		</div>
		<?php endif; ?>
		<div class="col s6 m12 l12">
			Finalizo el:
			<div class="input-field inline">
				<input id="first_name" type="text" class="validate" disabled>
				<label for="first_name">
					<?php if($orden['fecha_final'] == ""):?>
					Aun no ha finalizado
					<?php else: ?>
					<?php echo $orden['fecha_final']; ?>
					<?php endif; ?>
				</label>
			</div>
		</div>
		<div class="col s12 m12 ml12">
			<h4>Servicio: <?php echo $servicio['nombre']; ?></h4>
			<?php if($tecnico['nombre'] == ""): ?>
			<h4>Tecnico: <?php echo "Aún no se ha asignado"; ?></h4>
			<?php else: ?>

			<h4>Tecnico: <?php echo $tecnico['nombre']; ?></h4>

			<?php endif; ?>
		</div>
	</div>
	<?php if($orden['estatus'] == 1): ?>
	<button class="btn waves-effect waves-light finalizarOrden blue"><i class="material-icons left">check</i>Finalizar orden</button>
	<?php endif; ?>
</div>
<style>
body,html {
	height: 100%;
}
	.container {
		background-color: white;
		padding: 15px;
		border-radius: 10px;
		margin-top: 20px;
		box-shadow: 0 0 10px rgba(0,0,0,0.3);
		position: relative;
	}
	span.badge{
		background-color: #143568;
		padding: 1px;
		border-radius: 3px;
		position: absolute;
		top: 10px;
		color: white;
	}
	span.badge.estado {
		right: 10px;
	}
	.row > i {
		position: absolute;
		border-radius: 50%;
		right: 15px;
		top: 15px;
		padding: 8px;
		background-color: #143568;
		color: white;
	}
</style>
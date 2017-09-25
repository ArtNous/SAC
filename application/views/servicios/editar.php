<div class="container">
	<div class="row">
		<?php echo validation_errors(); ?>
		<?php echo form_open('servicios/editar/' . $servicio['codigo']); ?>
		<!-- <form class="col s6"> -->
			<div class="row">
				<div class="input-field col s6">
					<i class="prefix material-icons">visibility</i>
					<?php if($editar): ?>
						<input id="first_name" type="text" class="validate" value="<?php echo $servicio['codigo']; ?>" name="codigo">
					<?php else: ?>
						<input id="first_name" type="text" class="validate" value="<?php echo set_value('codigo'); ?>" name="codigo">
					<?php endif; ?>
					<label for="first_name">Codigo</label>
				</div>
				<div class="input-field col s6">
					<i class="prefix material-icons">account_circle</i>
					<?php if($editar): ?>
						<input id="last_name" type="text" class="validate" value="<?php echo $servicio['nombre']; ?>" name="nombre">
					<?php else: ?>
						<input id="last_name" type="text" class="validate" value="<?php echo set_value('nombre'); ?>" name="nombre">
					<?php endif; ?>
					<label for="last_name">Nombre</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<i class="prefix material-icons">description</i>
					<?php if($editar): ?>
						<input id="username" type="text" class="validate" value="<?php echo $servicio['descripcion']; ?>" name="descripcion">
					<?php else: ?>
						<input id="username" type="text" class="validate" value="<?php echo set_value('descripcion'); ?>" name="descripcion">
					<?php endif; ?>
					<label for="username">Descripcion</label>
				</div>
			</div>
			<button type="submit" class="btn waves-effect waves-light" name="submit"><i class="material-icons right">send</i></button>
	</div>
</div>
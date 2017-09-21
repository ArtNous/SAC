<div class="container">
	<div class="row">
		<?php if(isset($editar)): ?>
			<h4 class="center">Editar servicio</h4>
		<?php else: ?>
			<h4 class="center">Crear servicio</h4>
		<?php endif; ?>
		<?php echo validation_errors(); ?>
		<?php 
			if (isset($editar)){
				echo form_open('servicios/editar/' . $servicio['codigo']);
			} else {
				echo form_open('servicios/crear');
			}
		 ?>
			<div class="row">
				<div class="input-field col s6 m2 l2">
					<i class="prefix material-icons">visibility</i>
					<?php if (isset($editar)): ?>
						<input id="<?php echo $servicio['codigo'] ?>" onblur="verificarCodigoServicio(this.id)" type="text" class="validate" value="<?php echo $servicio['codigo']; ?>" name="codigo" data-length="5">
					<?php else: ?>
					<input onblur="verificarCodigoServicio(this.value)" type="text" class="validate" value="<?php echo set_value('codigo'); ?>" name="codigo" data-length="5">
					<?php endif; ?>					
					<label for="first_name">Codigo</label>
				</div>
				<div class="input-field col s6 m6 l6">
					<i class="prefix material-icons">account_circle</i>
					<?php if (isset($editar)): ?>
					<input id="last_name" type="text" class="validate" value="<?php echo $servicio['nombre']; ?>" name="nombre">
					<?php else: ?>
					<input id="last_name" type="text" class="validate" value="<?php echo set_value('nombre'); ?>" name="nombre">
					<?php endif; ?>					
					<label for="last_name">Nombre</label>
				</div>
				<div class="input-field col s6 m4 l4">
					<i class="prefix material-icons">account_circle</i>
					<?php if (isset($editar)): ?>
					<input id="km" type="number" class="validate" value="<?php echo $servicio['prox_km']; ?>" name="km">
					<?php else: ?>
					<input id="km" type="text" class="validate" value="<?php echo set_value('prox_km'); ?>" name="km">
					<?php endif; ?>					
					<label for="last_name">Próximo kilometraje</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<i class="prefix material-icons">description</i>
					<?php if (isset($editar)): ?>
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
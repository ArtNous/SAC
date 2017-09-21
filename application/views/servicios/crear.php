<div class="container">
	<div class="row">
		<?php if(isset($servicio)): ?>
			<h3 class="center">Editar servicio</h3>
		<?php else: ?>
			<h3 class="center">Crear servicio</h3>
		<?php endif; ?>
		<?php echo validation_errors(); ?>
		<?php 
		echo isset($servicio) ? form_open('servicios/crear/' . $servicio['codigo']) : form_open('servicios/crear');
		 ?>
			<div class="row">
				<div class="input-field col s6 m2 l2">
					<?php echo form_error('codigo'); ?>
					<i class="prefix material-icons">visibility</i>
					<?php 
						$data = array(
							"name" => "codigo",
							"class" => "validate",
							"value" => set_value("codigo"),
						);
						$attr = array(
							"data-length" => "5",
						);
						if(isset($servicio)){
							$data['value'] = set_value("codigo",$servicio['codigo']);
							$attr['disabled'] = true;
						}
						echo form_input($data,$attr);
					 ?>
					<label for="first_name">Codigo</label>
				</div>
				<div class="input-field col s6 m6 l6">
					<?php echo form_error('nombre'); ?>
					<i class="prefix material-icons">account_circle</i>
					<?php 
						$data = array(
							"name" => "nombre",
							"class" => "validate",
							"value" => set_value("codigo"),
						);
						$attr = array(
							//Atributos
						);
						if(isset($servicio)){
							$data['value'] = set_value("nombre",$servicio['nombre']);
							$attr['disabled'] = 'disabled';
						}
						echo form_input($data,$attr);
					 ?>
					<label for="last_name">Nombre</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<?php echo form_error('descripcion'); ?>
					<i class="prefix material-icons">description</i>
					<?php 
						$data = array(
							"name" => "descripcion",
							"class" => "validate",
							"value" => set_value("descripcion"),
						);
						$attr = array(
							//Atributos
						);
						if(isset($servicio)){
							$data['value'] = set_value("descripcion",$servicio['descripcion']);
							$attr['disabled'] = 'disabled';
						}
						echo form_input($data,$attr);
					 ?>
					<label for="username">Descripcion</label>
				</div>
			</div>
			<button type="submit" class="btn waves-effect waves-light" name="submit"><i class="material-icons right">send</i></button>
	</div>
</div>
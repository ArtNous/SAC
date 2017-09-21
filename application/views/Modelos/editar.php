<div class="container" style="margin-top: 20px;">
	<?php echo form_open('modelos/editar/'.$modelo['id']); ?>
	<div class="row">
	<div class="col s12 m9 l9">
		<div class="input-field col s12">
			<?php
				$datos[''] = 'Elige la marca';
				foreach ($marcas as $m) {
					$datos[$m['id']] = $m['nombre'];
				}
				echo form_dropdown('marca',$datos,$modelo['marca']);
			?>
			<label>Marca</label>
		</div>
		<div class="col s12 m3 l3">
			<?php echo form_error('marca'); ?>
		</div>
	</div>
	</div>
	<div class="row">
		<div class="input-field col s12 m9 l9">
			<div class="form-group">
				<label class="control-label" for="">Nombre del modelo</label>
				<span class="help-block"></span>
				<?php  
					$atributos = array(
						'name' => 'nombre',
						'id' => 'campo_nombre_modelo',
						'class' => 'form-control',
						'value' => $modelo['nombre'],
					);
					echo form_input($atributos);
				?>
			</div>
		</div>
		<div class="col s12 m3 l3">
			<?php echo form_error('nombre'); ?>
		</div>
	</div>
	<button type="submit" class="btn">Crear</button>
	<?php echo form_close(); ?>
</div>
<div class="container" style="margin-top: 20px;">
	<h3 class="center">Crear Modelo</h3>
	<?php echo form_open('modelos/crear'); ?>
	<div class="row">
		<div class="input-field col s12 m9 l9">
			<?php  
				$opciones[''] = 'Seleccione la marca';
				foreach($marcas as $m){
					$opciones[$m['id']] = $m['nombre'];
				}
				echo form_dropdown('marca',$opciones,set_value('marca'));
			?>
			
			<label>Marca</label>
		</div>
		<div class="col s12 m3 l3">
			<?php echo form_error('marca'); ?>			
		</div>
		<div class="input-field col s12 m9 l9">
			<div class="form-group">
				<label class="control-label" for="">Nombre del modelo</label>
				<span class="help-block"></span>
				<?php  
					$atributos = array(
						'name' => 'nombre',
						'id' => 'campo_nombre_modelo',
						'class' => 'form-control',
						'value' => set_value('nombre'),
					);
					echo form_input($atributos);
				?>
			</div>
		</div>
		<div class="col s12 m3 l3">
			<?php echo form_error('nombre'); ?>			
		</div>
	</div>
	<div class="row">
		<button type="submit" class="btn">Crear</button>
	</div>
		<?php echo form_close(); ?>			
</div>
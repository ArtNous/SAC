<div class="container" style="margin-top: 20px;">
	<h3 class="center">Crear Marca</h3>
	<div class="col s12 m12 l12">
		<?php echo isset($marca) ? form_open('Marcas/editar/' . $marca['id']) : form_open('Marcas/crear'); ?>
		<div class="input-field">
			<div class="form-group">
				<label class="control-label" for="">Nombre de la marca</label>
				<span class="help-block"></span>
				<?php 
					$atributos = array(
						'name' => 'nombre',
						'id' => 'campo_nombre_marca',
						'value' => isset($marca) ? set_value('nombre',$marca['id']) : "",
						'class' => 'form_control',
					);
					echo form_input($atributos);
				?>
			</div>
		</div>
		
		<button type="submit" class="btn">Crear</button>
		<?php echo form_error('nombre'); ?>
	</form>
</div>
</div>
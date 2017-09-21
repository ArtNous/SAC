<div class="container">
	<div class="row">
		<h3 class="center">Crear Tipo de Vehículo</h3>
		<?php echo form_open('tipos_vehiculos/crear'); ?>
			<div class="row">
				<div class="input-field col s6">
					<?php 
						$atributos = array(
							'name' => 'descripcion',
							'id' => 'descripcion',
							'value' => set_value('descripcion'),
							'class' => 'validate',
						);
						echo form_input($atributos);
					?>
					<label for="descripcion">Descripción del tipo de vehículo</label>
				</div>
			</div>
			<button type="submit" class="btn waves-effect waves-light" name="submit"><i class="material-icons right">send</i></button>
			<?php echo form_error('descripcion'); ?>
		</form>
	</div>
</div>
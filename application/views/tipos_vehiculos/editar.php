<div class="container">
	<div class="row">
		<?php echo form_open('tipos_vehiculos/editar/' . $tipo['id']); ?>
			<div class="row">
				<div class="input-field col s6">
					<?php 
						$atributos = array(
							'name' => 'descripcion',
							'id' => 'descripcion',
							'value' => $tipo['descripcion'],
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
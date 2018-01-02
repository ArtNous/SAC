<div class="container">
	<div class="row">
		<h3 class="center">Crear tiempo de atención</h3>
		<p><b>En esta sección puedes crear el tiempo de atención estimado para un determinado <a href="<?php echo base_url('servicios'); ?>">servicio</a> con un específico <a href="<?php echo base_url('tipos_vehiculos'); ?>">automovil</a>.</b></p>
		<?php 
			if(isset($campos)){
				echo form_open('tiempos/crear/' . $campos['tipo_vehiculo'] . '/' . $campos['servicio']);
			} else {
				echo form_open('tiempos/crear');
			}
		?>
		<div class="row">
			<div class="col s12 m4 l4">
				<div class="input-field col s12 m12 l12">
					<?php echo form_error('servicio'); ?>
					<?php  
						$atributos[''] = 'Seleccione el servicio';
						foreach($servicios as $s){
							$atributos[$s['Codigo']] = $s['Nombre'];
						}
						echo form_dropdown('servicio',$atributos,isset($campos['servicio']) ? $campos['servicio'] : "",'id="ser-serv"');
					?>
					<label>Servicio</label>
				</div>
				<div class="input-field col s12 m12 l12">
					<?php echo form_error('tipo'); ?>
					<?php  
						$opciones[''] = 'Seleccione el tipo de vehículo';
						foreach($tipos as $tv){
							$opciones[$tv['id']] = $tv['descripcion'];
						}
						echo form_dropdown('tipo',$opciones,isset($campos['tipo_vehiculo']) ? $campos['tipo_vehiculo'] : "");
					?>
					<label>Tipo de vehículo</label>
				</div>
				<div class="input-field col s12 m12 l12">
					<?php echo form_error('kilometraje'); ?>
					<label for="txtKilometraje">Kilometraje</label>
					<?php  
						$input_opc = array(
							'name' => 'kilometraje',
							'id' => 'txtKilometraje',
							'class' => 'form-control',
							'type' => 'number',
						);
						$input_opc['value'] = set_value("kilometraje",isset($campos['kilometraje']) ? $campos['kilometraje']: "");
						echo form_input($input_opc);
					?>
				</div>
			</div>
			<div class="col s12 m8 l8">
				<div class="col s12 m9 l9 minutos">
					<?php echo form_error('tiempo'); ?>
					<p class="range-field">
						<label for="tiempo_minutos">Establece el tiempo de atención</label>
						<?php  
							$input1_opc = array(
							'name' => 'tiempo',
							'id' => 'tiempo_minutos',
							'type' => 'range',
							'min' => '0',
							'max' => '100',
							'type' => 'range',
						);
							$input1_opc['value'] = set_value('tiempo',isset($campos['tiempo']) ? $campos['tiempo'] : "");
						echo form_input($input1_opc);
						?>
					</p>
					<h3 class="center"></h3>
				</div>
				<div class="col s12 m3 l3 minutos input-field">
					<label for="txtTiempo">Tiempo</label>
					<?php  
						$atributos = array(
							'name' => 'tiempo_largo',
							'id' => 'txtTiempo',
							'class' => 'form-control',
							'value' => set_value('tiempo_largo'),
							'type' => 'number',
						);
						$atributos['value'] = set_value('tiempo_largo',isset($campos) ? $campos['tiempo'] : "");
						echo form_input($atributos);
					?>
				</div>
			</div>
		</div>
		<button type="submit" class="btn waves-effect waves-light" name="submit"><i class="material-icons right">send</i></button>
	</form>
</div>
</div>
<script>
	document.getElementById('txtTiempo').addEventListener('blur', e => {
		document.getElementById('tiempo_minutos').value = e.currentTarget.value;
	});
</script>
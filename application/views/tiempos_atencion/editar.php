<div class="container">
	<div class="row">
		<h4 class="center">Editar tiempo de atención</h4>
		<?php echo validation_errors(); ?>
		<?php echo form_open('tiempos/editar/' . $campos['tipo_vehiculo'] . "/" . $campos['servicio']) ; ?>
		<div class="row">
			<div class="col s12 m6 l6">
				<div class="input-field col s12 m12 l12">
					<select name="servicio" value="<?php set_value('servicio',isset($campos['servicio']) ? $campos['servicio'] : ""); ?>">
						<option value="" disabled selected>Eliga el servicio</option>
						<?php foreach($servicios as $serv): ?>
						<option value="<?php echo $serv['codigo']; ?>"><?php echo $serv['nombre']; ?></option>
						<?php endforeach; ?>
					</select>
					<label>Servicio</label>
				</div>
				<div class="input-field col s12 m12 l12">
					<select name="tipo" value="<?php set_value('tipo',isset($campos['tipo_vehiculo']) ? $campos['tipo_vehiculo'] : ""); ?>">
						<option value="" disabled selected>Eliga el tipo de vehículo</option>
						<?php foreach($tipos as $tv): ?>
						<option value="<?php echo $tv['id']; ?>"><?php echo $tv['descripcion']; ?></option>
						<?php endforeach; ?>
					</select>
					<label>Tipo de vehículo</label>
				</div>
			</div>
			<div class="col s12 m6 l6">
				<p class="range-field">
					<label for="tiempo_minutos">Establece el tiempo de atención</label>
					<input type="range" id="tiempo_minutos" min="0" max="100" name="tiempo" value="<?php set_value('tiempo',isset($campos['tiempo']) ? $campos['tiempo'] : "50"); ?>" />
				</p>
				<div class="minutos">
					<h3 class="center"></h3>
				</div>
			</div>
		</div>
		<button type="submit" class="btn waves-effect waves-light" name="submit"><i class="material-icons right">send</i></button>
	</form>
</div>
</div>
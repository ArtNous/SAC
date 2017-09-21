<div class="container">
	<div class="row">
		<div class="col s12 m4 l4">
			Cédula del cliente:
			<div class="input-field inline">
				<input id="txtRif" type="text" class="validate" onfocus="autocompletarCliente(3)" name="codigo">
				<label for="txtRif" data-error="Error" data-success="Correcto">RIF</label>
			</div>
		</div>
		<div class="col s12 m8 l8">
			<h3 id="nombreCliente"></h3>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m4 l4">
			Placa del vehículo:
			<div class="input-field inline">
				<input id="txtPlaca" type="text" class="validate" onfocus="autocompletarCliente(4)" name="placa">
				<label for="txtPlaca" data-error="Error" data-success="Correcto">Placa</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m12 l12">
			<button id="btnBuscarOrdenesCliente" class="btn waves-effect waves-purple">Buscar</button><?php echo form_close(); ?>
			<?php echo validation_errors(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m12 l12" id="nombreClienteOrden"></div>
		<div class="col s12 m12 l12" id="lista-ordenes-cliente"></div>
	</div>
</div>
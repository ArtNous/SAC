<div class="container">
	<div class="row">
		<?php echo form_open('cliente/buscar'); ?>
		<div class="col s12 m12 l12">
			Buscar cliente por rif:
			<div class="input-field inline">
				<input onfocus="autocompletarCliente(1)" id="rif-buscar" type="text" class="autocomplete rif" name="rif">
				<label for="rif">RIF</label>
			</div>
			<button type="submit" class="btn waves-effect waves-light"><i class="material-icons" id="btnRif">search</i></button>
			<button type="button" class="btnLimpiar btn waves-effect waves-light"><i class="material-icons">clear</i></button>
		</div>
		<?php echo form_close(); ?>
		<?php echo form_open('cliente/buscar'); ?>
		<div class="col s12 m12 l12">
			Buscar cliente por nombre:
			<div class="input-field inline">
				<input id="nombre-buscar" type="text" class="validate" name="nombre" onfocus="autocompletarCliente(2)">
				<label for="rif" data-error="Error" data-success="right">Nombre</label>
			</div>
			<button type="submit" class="btn waves-effect waves-light"><i class="material-icons" id="btnNombre">search</i></button>
			<button type="button" class="btnLimpiar btn waves-effect waves-light"><i class="material-icons">clear</i></button>
		</div>
		<?php echo form_close(); ?>
		<?php echo validation_errors(); ?>
	</div>
	<div class="row" id="ficha-cliente">
		<div class="col s12 m12 l12">
			
		</div>
	</div>
</div>
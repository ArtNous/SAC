<div class="container">
	<div class="row" style="margin-top: 15px;">
		<div class="col s12 m3 l3">
			<a href="<?php echo base_url('tiempos/crear'); ?>" class="btn-large">Crear</a>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m6 l6">
			<ul class="collapsible" data-collapsible="accordion">
				<?php foreach($servicios as $s):?>
				<li>
					<div class="collapsible-header"><i class="material-icons">build</i><?php echo $s['nombre']; ?></div>
					<div class="collapsible-body">
						<span>Lorem ipsum dolor sit amet.</span>
					</div>
				</li>
				<?php endforeach;?>
			</ul>
		</div>
	</div>
	<div id="modalEditarTiempo" class="modal">
		<div class="modal-content">
			<h4></h4>
			<div class="input-field col s6">
				<?php echo form_open('tiempos/editar'); ?>
				<input id="txtNombreTiempo" type="text" class="validate" name="nombre">
				<label for="txtNombreTiempo">Nombre nuevo</label>
				<input id="txtIdModeloEscondido" type="text" class="validate" name="id" style="display: none;">
			</div>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Salir</a>
			<button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Modificar</button>
		</div>
	</div>
	<div id="modalBorrarModelo" class="modal">
		<div class="modal-content">
			<h4></h4>
			<div class="col s6">
				¿Esta seguro que desea borrar el modelo?
			</div>
		</div>
		<div class="modal-footer">
			<?php echo form_open('modelos/eliminar'); ?>
			<input type="text" name="id" style="display: none;" id="txtIdEliminar">
			<button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat">Si</button>
			<a href="<?php echo base_url('index.php/modelos/eliminar/') ?>" class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
		</div>
	</div>
</div>
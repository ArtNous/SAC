<div class="container-fluid">
	<div class="row">
		<div class="col s12 m12 l12" style="margin: 10px 30px">
			<h3 class="center">Lista de clientes</h3>
			<div id="lista-clientes-webix"></div>
			<div id="paginador" style="width: 40%"></div>	
		</div>
		<div class="col s12 m12 l12" style="margin: 10px 30px">
			<a href="<?php echo base_url('cliente/crear'); ?>" class="btn">Crear cliente</a>
			<a href="" class="btn waves-effect waves-light" style="display: none" id="btnModificar"><i class="material-icons left">edit</i>Modificar</a>
			<a href="" class="btn red waves-effect waves-light" style="display: none" id="btnEliminar"><i class="material-icons left">clear</i>Eliminar</a>
		</div>
	</div>
</div>
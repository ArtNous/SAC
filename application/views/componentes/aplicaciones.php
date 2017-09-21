<div class="container-fluid">
	<div class="row">
		<!-- <h3 class="center">Módulo de atención al cliente</h3> -->
		<div class="col s12 m4">
			<!-- Boton grande de opción -->
			<div class="card-panel blue center">
				<h3 class="titulo-opcion"><i class="material-icons large">group</i></h3>
				<a class="waves-effect waves-light btn-large red" href="<?php echo base_url('cliente'); ?>">Clientes</a>
			</div>
			<!-- ./ -->
		</div>
		<div class="col s12 m4">
			<div class="card-panel green center">
				<h3 class="titulo-opcion"><i class="material-icons large">description</i></h3>
				<a onclick="$('.tap-target').tapTarget('open')" class="waves-effect waves-light btn-large red">Orden de servicio</a>
			</div>
		</div>
		<div class="col s12 m4">
			<div class="card-panel orange center">
				<h3 class="titulo-opcion"><i class="material-icons large">apps</i></h3>
				<a class="waves-effect waves-light btn-large red" href="<?php echo base_url('servicios'); ?>">Servicios</a>
			</div>
		</div>
		<div class="col s12 m4">
			<div class="card-panel green center">
				<h3 class="titulo-opcion"><i class="material-icons large">build</i></h3>
				<a class="waves-effect waves-light btn-large red" href="<?php echo base_url('configuracion'); ?>">Configuración</a>
			</div>
		</div>
	</div>
</div>
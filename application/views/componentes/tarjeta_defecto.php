<div class="container">
	<div class="row">
	<?php foreach($servicios as $servicio): ?>
		<div class="col s12 m3">
			<div class="card blue-grey darken-1">
				<div class="card-content white-text">
					<span class="card-title"><?php echo $servicio->nombre;?></span>
					<p><?php echo $servicio->descripcion;?></p>
				</div>
				<div class="card-action">
					<a href="#">Ver operaciones</a>
				</div>
			</div>
		</div>
	<?php endforeach;?>
	</div>
</div>
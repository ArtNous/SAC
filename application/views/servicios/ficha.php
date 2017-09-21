	<h3 class="center">Servicio</h3>
<div class="container">
	<div class="row">
 		<h4 class="center"><?php echo $servicio['nombre']; ?></h4>
		<div class="col s12 m12 l12">
			<p><?php echo $servicio['descripcion']; ?></p>
		</div>
	</div>
</div>
<style>
	.botones {
		position: absolute;
		right: 15px;
		top: 10px;
	}
	.container {
		background-color: white;
		padding: 15px;
		border-radius: 10px;
		margin-top: 20px;
		box-shadow: 0 0 10px rgba(0,0,0,0.3);
		position: relative;
	}

	span.badge{
		background-color: #143568;
		padding: 1px;
		border-radius: 3px;
		position: absolute;
		top: 10px;
		color: white;
	}
	.row > i {
		position: absolute;
		border-radius: 50%;
		right: 15px;
		top: 15px;
		padding: 8px;
		background-color: #143568;
		color: white;
	}
</style>
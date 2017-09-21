	<h3 class="center">Vehículo</h3>
<div class="container">
	<div class="row">
 		<h4 class="center"><?php echo $auto['placa']; ?></h4>
		<div class="col s6 m12 l12">
			Marca: 
			<div class="input-field inline">
				<input id="first_name" type="text" class="validate" disabled>
				<label for="first_name"><?php echo $auto['marca']; ?></label>
			</div>
			Modelo: 
			<div class="input-field inline">
				<input id="first_name" type="text" class="validate" disabled>
				<label for="first_name"><?php echo $auto['modelo']; ?></label>
			</div>
			Tipo de vehiculo: 
			<div class="input-field inline">
				<input id="first_name" type="text" class="validate" disabled>
				<label for="first_name"><?php echo $auto['tipo_vehiculo']; ?></label>
			</div>
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
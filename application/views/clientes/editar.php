<div class="container">
	<div class="row">
		<div class="card">
			<a href="#!" class="btn-floating waves-effect waves-light tooltiped" data-position="left" data-tooltip=""><i class="material-icons">edit</i></a>
			<div class="card-content">
				<h5 class="center"><?php echo $cliente['Nombre']; ?></h5>
			</div>
			<div class="card-tabs">
				<ul class="tabs tabs-fixed-width">
					<li class="tab"><a class="active" href="#tab-info">Información general</a></li>
					<li class="tab"><a href="#tab-autos">Vehículos</a></li>
				</ul>
			</div>
			<div class="card-content grey lighten-4">
				<div id="tab-info">
					<div class="row">
						<div class="col s12">
							<div class="row">
								<div class="input-field col s4 m3 l3">
									<input id="first_name" type="text" class="validate" value="<?php echo $cliente['RIF']; ?>">
									<label for="first_name">RIF</label>
								</div>
								<div class="input-field col s4 m3 l3">
									<input id="last_name" type="text" class="validate" value='<?php echo $cliente['CodigoCliente']; ?>'>
									<label for="last_name">Código</label>
								</div>
								<div class="input-field col s4 m3 l3">
									<input id="last_name" type="text" class="validate" value='<?php if($cliente['NIT'] == null){ echo "No tiene";} else {echo $cliente['NIT'];} ?>'>
									<label for="last_name">NIT</label>
								</div>
								<div class="input-field col s4 m3 l3">
									<input id="last_name" type="text" class="validate" value='<?php echo $cliente['Zona']; ?>'>
									<label for="last_name">Zona</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input disabled value="<?php if($cliente['RazonSocial'] == null){ echo "No tiene";} else {echo $cliente['RazonSocial'];} ?>" id="disabled" type="text" class="validate">
									<label for="disabled">Razón social</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="password" value="<?php echo $cliente['Direccion'] ?>" type="text">
									<label for="password">Dirección</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="email" type="text" value="<?php if($cliente['DireccionEnvio'] == null){ echo "No tiene";} else {echo $cliente['DireccionEnvio'];} ?>">
									<label for="email">Dirección de envio</label>
								</div>
							</div>
							<div class="row">
								<div class="col s12 m4 l4">
									Ciudad: 
									<div class="input-field inline">
										<input value="<?php if($cliente['Ciudad'] == null) { echo "No tiene";} else { echo $cliente['Ciudad'];} ?>" type="text">
										<label for="email"></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Estado: 
									<div class="input-field inline">
										<input value="<?php if($cliente['Estado'] == null) { echo "No tiene";} else { echo $cliente['Estado'];} ?>" type="text">
										<label></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Municipio: 
									<div class="input-field inline">
										<input value="<?php if($cliente['Municipio'] == null) { echo "No tiene";} else { echo $cliente['Municipio'];} ?>" type="text">
										<label></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col s12 m4 l4">
									E-mail: 
									<div class="input-field inline">
										<input value="<?php if($cliente['email'] == null) { echo "No tiene";} else { echo $cliente['email'];} ?>" type="email">
										<label></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Teléfono: 
									<div class="input-field inline">
										<input value="<?php if($cliente['Telefonos'] == null) { echo "No tiene";} else { echo $cliente['Telefonos'];} ?>" type="text">
										<label></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Fax: 
									<div class="input-field inline">
										<input value="<?php if($cliente['Fax'] == null) { echo "No tiene";} else { echo $cliente['Fax'];} ?>" type="text">
										<label></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col s12 m4 l4">
									Codigo grupo: 
									<div class="input-field inline">
										<input value="<?php echo $cliente['CodigoGrupo']; ?>" type="text">
										<label></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Estatus: 
									<div class="input-field inline">
										<input value="<?php if($cliente['Estatus'] == "A") { echo "Activo";} else { echo "Inactivo";} ?>" type="text">
										<label></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Tarifa: 
									<div class="input-field inline">
										<input value="<?php echo $cliente['Tarifa'];?>" type="text">
										<label></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col s12 m4 l4">
									Cod Contable: 
									<div class="input-field inline">
										<input value="<?php if($cliente['CodigoContable'] == null) { echo "No tiene";} else { echo $cliente['CodigoContable'];} ?>" type="text">
										<label></label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="tab-autos">
					
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.card .btn-floating {
		position: absolute;
		right: 15px;
		top: 10px;
	}
	#tab-info .bloque{
		display: inline-block;
		width: 50%;
		/*float: left;*/
	}
	#tab-info .fila {
		width: 100%;
		border-bottom: 1px solid rgba(0,0,0,0.3);
		padding: 3px 0;
	}
	#tab-info .fila .desc,
	#tab-info .fila .valor{
		display: inline-block;
	}
	#tab-info .desc{
		width: 140px;
	}
	#tab-info .valor {
		width: 100px;
	}
</style>
<div class="container">
	<div class="row">
		<div class="card">
			<div class="botones">
				<button onclick="activarCampos()" class="btn-floating waves-effect waves-light tooltipped" data-position="bottom" data-tooltip="Editar datos" data-delay="50"><i class="material-icons" id="btnActivarCampos">edit</i></button>
				<button onclick="desactivarCampos()" class="btn-floating waves-effect waves-light tooltipped" style="display: none" data-position="bottom" data-tooltip="Cancelar" data-delay="50" id="btnDesactivarCampos"><i class="material-icons">clear</i></button>
			</div>
			<div class="card-content">
				<h4 class="center"><?php echo $cliente['Nombre']; ?></h4>
			</div>
			<div class="card-tabs">
				<ul class="tabs tabs-fixed-width">
					<li class="tab"><a class="active" href="#tab-info">Información general</a></li>
					<li class="tab"><a href="#tab-autos">Vehículos</a></li>
				</ul>
			</div>
			<div class="card-content grey lighten-4">
				<div id="tab-info">
					<?php echo form_open('cliente/editar'); ?>
					<div class="row">
						<div class="col s12">
							<div class="row">
								<div class="input-field col s4 m3 l3">
									<input id="first_name" name="rif" type="text" class="validate" value="<?php echo $cliente['RIF']; ?>" disabled>
									<label for="first_name">RIF</label>
								</div>
								<div class="input-field col s4 m3 l3">
									<input id="last_name" name="codigo" type="text" class="validate" value='<?php echo $cliente['CodigoCliente']; ?>' disabled>
									<label for="last_name">Código</label>
								</div>
								<div class="input-field col s4 m3 l3">
									<input id="nit" name="nit" type="text" class="validate" value='<?php if($cliente['NIT'] == null){ echo "No tiene";} else {echo $cliente['NIT'];} ?>' disabled>
									<label for="nit">NIT</label>
								</div>
								<div class="input-field col s4 m3 l3">
									<input id="last_name" name="zona" type="text" class="validate" value='<?php echo $cliente['Zona']; ?>' disabled>
									<label for="last_name">Zona</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input disabled value="<?php if($cliente['RazonSocial'] == null){ echo "No tiene";} else {echo $cliente['RazonSocial'];} ?>" id="disabled" name="razonS" type="text" class="validate">
									<label for="disabled">Razón social</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="password" name="direccion" value="<?php echo $cliente['Direccion'] ?>" type="text" disabled>
									<label for="password">Dirección</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input id="email" name="direccionE" type="text" value="<?php if($cliente['DireccionEnvio'] == null){ echo "No tiene";} else {echo $cliente['DireccionEnvio'];} ?>" disabled>
									<label for="email">Dirección de envio</label>
								</div>
							</div>
							<div class="row">
								<div class="col s12 m4 l4">
									Ciudad:
									<div class="input-field inline">
										<input value="<?php if($cliente['Ciudad'] == null) { echo "No tiene";} else { echo $cliente['Ciudad'];} ?>" type="text" name="ciudad" disabled>
										<label for="email"></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Estado:
									<div class="input-field inline">
										<input value="<?php if($cliente['Estado'] == null) { echo "No tiene";} else { echo $cliente['Estado'];} ?>" type="text" name="estado" disabled>
										<label></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Municipio:
									<div class="input-field inline">
										<input value="<?php if($cliente['Municipio'] == null) { echo "No tiene";} else { echo $cliente['Municipio'];} ?>" type="text" name="municipio" disabled>
										<label></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col s12 m4 l4">
									E-mail:
									<div class="input-field inline">
										<input value="<?php if($cliente['email'] == null) { echo "No tiene";} else { echo $cliente['email'];} ?>" type="email" name="email" disabled>
										<label></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Teléfono:
									<div class="input-field inline">
										<input value="<?php if($cliente['Telefonos'] == null) { echo "No tiene";} else { echo $cliente['Telefonos'];} ?>" type="text" name="tlf" disabled>
										<label></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Fax:
									<div class="input-field inline">
										<input value="<?php if($cliente['Fax'] == null) { echo "No tiene";} else { echo $cliente['Fax'];} ?>" type="text" name="fax" disabled>
										<label></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col s12 m4 l4">
									Codigo grupo:
									<div class="input-field inline">
										<input value="<?php echo $cliente['CodigoGrupo']; ?>" type="text" name="codGrupo" disabled>
										<label></label>
									</div>
								</div>
								<div class="col s12 m4 l4" id="estatus">
									Estatus:
									<div class="input-field inline">
										<input value="<?php if($cliente['Estatus'] == "A") { echo "Activo";} else { echo "Inactivo";} ?>" name="estatus" type="text" disabled>
										<label></label>
									</div>
								</div>
								<div class="col s12 m4 l4">
									Tarifa:
									<div class="input-field inline">
										<input value="<?php echo $cliente['Tarifa'];?>" name="tarifa" type="text" disabled>
										<label></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col s12 m4 l4">
									Cod Contable:
									<div class="input-field inline">
										<input value="<?php if($cliente['CodigoContable'] == null) { echo "No tiene";} else { echo $cliente['CodigoContable'];} ?>" name="codContable" type="text" disabled>
										<label></label>
									</div>
								</div>
								<div class="col s12 m5 l5">
									Documento fiscal:
									<div class="input-field inline">
										<input value="<?php if($cliente['DocumentoFiscal'] == null) { echo "No tiene";} else { echo $cliente['DocumentoFiscal'];} ?>" name="df" type="text" disabled>
										<label></label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="submit" class="btn waves-effect waves-light"><i class="material-icons">send</i></button>
				</div>
				<?php echo validation_errors(); ?>
				<?php echo form_close(); ?>
				<div id="tab-autos">
					<?php echo $autos_vista; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.card .botones {
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
	#tab-info button[type="submit"]{
		display: none;
	}
</style>
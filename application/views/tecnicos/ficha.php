<div class="container">
	<div class="row">
		<div class="card">
			<div class="card-content">
				<h4 class="center"><?php echo $tecnico['nombre']; ?></h4>
			</div>
			<div class="card-tabs">
				<ul class="tabs tabs-fixed-width">
					<li class="tab"><a class="active" href="#tab-info">Información general</a></li>
					<li class="tab"><a href="#tab-autos">Servicios</a></li>
				</ul>
			</div>
			<div class="card-content grey lighten-4">
				<div id="tab-info">
					<div class="row">
						<div class="col s12">
							<div class="row">
								<div class="input-field col s4 m3 l3">
									<input id="first_name" name="cedula" type="text" class="validate" value="<?php echo $tecnico['cedula']; ?>" disabled>
									<label for="first_name">Cédula</label>
								</div>
								<div class="input-field col s4 m3 l3">
									<input id="last_name" name="estatus" type="text" class="validate" value='<?php echo $tecnico['estatus']; ?>' disabled>
									<label for="last_name">Estatus</label>
								</div>
								<div class="input-field col s4 m3 l3">
									<input id="last_name" name="int" type="text" class="validate" value='<?php echo $tecnico['codigoINT']; ?>' disabled>
									<label for="last_name">Código INT</label>
								</div>
							</div>
						</div>
					</div>
				</div>
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
<div class="container">
	<div class="row">
		<div class="col s12 m6 l6">
			<h4 class="center">Ordenes por mes</h4>
			<div id="reporte1" style="width:600px;height:250px;margin:20px"></div>
			<div class="col s12 m6 l6">
				<select name="servicio" value="" id="serv-reporte1">
					<option value="" disabled selected>Servicio</option>
					<?php foreach($servicios as $s): ?>
					<option value="<?php echo $s['codigo']; ?>"><?php echo $s['nombre']; ?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="col s12 m6 l6">
				<select name="servicio" value="" id="mes-reporte1">
					<option value="" disabled selected>Mes</option>
					<option value="1">Enero</option>
					<option value="2">Febrero</option>
					<option value="3">Marzo</option>
					<option value="4">Abril</option>
					<option value="5">Mayo</option>
					<option value="6">Junio</option>
					<option value="7">Julio</option>
					<option value="8">Agosto</option>
					<option value="9">Septiembre</option>
					<option value="10">Octubre</option>
					<option value="11">Noviembre</option>
					<option value="12">Diciembre</option>
				</select>
			</div>
			<div class="col s12 m12 l12">
				<p><b>Reporte de ordenes de servicio agrupadas por dias del mes seleccionado.</b></p>
			</div>
		</div>
		<div class="col s12 m6 l6">
			<h4 class="center">Ordenes por año</h4>
			<div id="reporte2" style="width:600px;height:250px;margin:20px"></div>
			<div class="col s12 m6 l6">
				<select name="servicio" value="" id="serv-reporte2">
					<option value="" disabled selected>Servicio</option>
					<?php foreach($servicios as $s): ?>
					<option value="<?php echo $s['codigo']; ?>"><?php echo $s['nombre']; ?></option>
					<?php endforeach;?>
				</select>
			</div>
			<div class="col s12 m6 l6">
				<select name="servicio" value="" id="anio-reporte2">
					<option value="" disabled selected>Año</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2024</option>
					<option value="2025">2025</option>
					<option value="2026">2026</option>
					<option value="2027">2027</option>
					<option value="2028">2028</option>
				</select>
			</div>
			<div class="col s12 m12 l12">
				<p><b>Reporte de ordenes de servicio agrupadas por mes del año seleccionado.</b></p>
			</div>
		</div>
	</div>
</div>
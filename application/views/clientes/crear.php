<div class="container">
	<div class="row">
		<?php if($opcion == 1){
			echo "<h3 class='center'>Crear cliente</h3>";
			$atributos = array('id' => 'formCliente');
			echo form_open('cliente/crear',$atributos);
		} else {
			echo "<h3 class='center'>Modificar cliente</h3>";
			echo form_open('cliente/crear/' . $cliente['RIF']);
		}
		?>
		<div class="row">
			<div class="input-field col s6 m2 l2">
				<?php 
					$atributos = array(
						'name' => 'codigo',
						'id' => 'Cod',
						'value' => $opcion != 1 ? set_value('codigo',$cliente['CodigoCliente']) : "",
						'class' => 'validate',
						'onblur' => "verificarCliente(this.value)",
					);
					echo form_input($atributos);
					$atributos = null;
				?>
				<label for="Cod">Código</label>
			</div>
			<div class="input-field col s6 m2 l2">
				<?php 
					$atributos = array(
						'name' => 'rif',
						'id' => 'rif',
						'value' => $opcion != 1 ? set_value('rif',$cliente['RIF']) : "",
						'class' => 'validate',
						'onblur' => "verificarCliente(this.value)",
					);
					echo form_input($atributos);
					$atributos = null;
				?>
				<label for="rif">RIF</label>
			</div>
			<div class="input-field col s6 m4 l4">
				<?php echo form_error('grupo'); ?>
				<?php 
				if($opcion == 1){
					echo form_dropdown('grupo',$grupos,'','id="grupo"');
				}
				else {
					echo form_dropdown('grupo',$grupos,$cliente['CodigoGrupo'],'id="grupo"');
				}
				?>
				<label for="grupo">Grupo</label>
			</div>
			<div class="input-field col s6 m4 l4">
				<?php echo form_error('zona'); ?>
				<?php 
				if($opcion == 1){
					echo form_dropdown('zona',$zonas,'','','id="zona"');
				}
				else {
					echo form_dropdown('zona',$zonas,$cliente['Zona'],'id="zona"');
				}
				?>
				<label for="zona">Zona</label>
			</div>
			<div class="col s6 m4 l4">
				<?php if($opcion == 1): ?>
				<h4 id="cliente_existe" style="background-color: orange; border-radius: 3px" class="center"></h4>
				<?php elseif (isset($msj)): ?>
				<h4 id="msj" style="background-color: orange; border-radius: 3px" class="center"><?php echo $msj; ?></h4>
				<?php endif; ?>
			</div>
			<div class="input-field col s12 m12 l12">
				<i class="material-icons prefix">account_circle</i>
				<?php echo form_error('nombre'); ?>
				<?php 
					if($opcion == 1){
						$opciones = array(
							'name' => 'nombre',
							'id' => 'nombres',
							'value' => set_value('nombre'),
							'class' => 'validate',
						);
						echo form_input($opciones);
					} else{
						$opciones = array(
							'name' => 'nombre',
							'id' => 'nombres',
							'value' => $cliente['Nombre'],
							'class' => 'validate',
						);
						echo form_input($opciones);
					}
				?>
				<label for="nombres">Nombres completo</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12 m12 l12">
				<i class="material-icons prefix">business</i>
				<?php 
					if($opcion == 1){
						$opciones = array(
							'name' => 'razonS',
							'id' => 'razon',
							'value' => set_value('RazonSocial'),
							'class' => 'validate',
						);
					} else{
						$opciones = array(
							'name' => 'razonS',
							'id' => 'razon',
							'value' => $cliente['RazonSocial'],
							'class' => 'validate',
						);
					}
					echo form_input($opciones);
				?>
				<label for="razon">Razón social</label>
			</div>
			<div class="input-field col s12 m12 l12">
				<i class="material-icons prefix">home</i>
				<?php 
					if($opcion == 1){
						$opciones = array(
							'name' => 'direccion',
							'id' => 'direccion-sel',
							'value' => set_value('direccion'),
							'class' => 'validate',
						);
					} else{
						$opciones = array(
							'name' => 'direccion',
							'id' => 'direccion-sel',
							'value' => $cliente['Direccion'],
							'class' => 'validate',
						);
					}
					echo form_input($opciones);
				?>
				<label for="razon">Dirección</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s4 m4 l4">
				<?php echo form_error('RegimenIVA'); 
					$ivas = array(
						'O' => 'Ordinario',
						'N' => 'No registrado',
						'E' => 'Especial',
						'F' => 'Formal',
						'0' => 'X-Exento',
					);
					if($opcion == 1){
						echo form_dropdown('regimeniva',$ivas,'','id="riva"');
					}
					else {
						echo form_dropdown('regimeniva',$ivas,$cliente['RegimenIVA'],'id="riva"');
					}
					?>
				<label for="riva">Régimen IVA</label>
			</div>
			<div class="input-field col s4 m5 l5">
				<i class="material-icons prefix">phone</i>
				<?php 
					if($opcion == 1){
						$opciones = array(
							'name' => 'tlf',
							'id' => 'tlf',
							'value' => set_value('tlf'),
							'class' => 'validate',
						);
					} else{
						$opciones = array(
							'name' => 'tlf',
							'id' => 'tlf',
							'value' => $cliente['Telefonos'],
							'class' => 'validate',
						);
					}
					echo form_input($opciones);
				?>
				<label for="dir">Teléfono</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6 m4 l4">
					<?php echo form_error('estado'); ?>
					<?
						if($opcion == 1){
							echo form_dropdown('estado',$estados,'','id="estado"');
						}
						else {
							echo form_dropdown('estado',$estados,$cliente['Estado'],'id="estado"');
						}
					?>
				<label>Estado</label>
			</div>
			<div class="input-field col s6 m4 l4">
					<?php echo form_error('ciudad'); ?>
					<?
						if($opcion == 1){
							echo form_dropdown('ciudad',$ciudades,'','id="ciudad');
						}
						else {
							echo form_dropdown('ciudad',$ciudades,$cliente['Ciudad'],'id="ciudad');
						}
					?>
				<label>Ciudad</label>
			</div>
			<div class="input-field col s6 m4 l4">
					<?php echo form_error('municipio'); ?>
					<?
						if($opcion == 1){
							echo form_dropdown('municipio',$municipios,'','id="municipio"');
						}
						else {
							echo form_dropdown('municipio',$municipios,$cliente['Municipio'],'id="municipio"');
						}
					?>
				<label>Municipio</label>
			</div>
		</div>
		<button type="submit" class="btn green waves-effect waves-light" name="submit" id="btnRegCliente"><i class="material-icons right">send</i></button>
	</form>
</div>
</div>
<div class="container">
	<div class="row">
		<?php if($opcion == 1){
			echo "<h3 class='center'>Crear cliente</h3>";
			echo form_open('cliente/crear');
		} else {
			echo "<h3 class='center'>Modificar cliente</h3>";
			echo form_open('cliente/crear/' . $cliente['RIF']);
		}
		?>
		<div class="row">
			<div class="input-field col s6 m2 l2">
				<?php if($opcion == 1): ?>
					<?php echo form_error('codigo','<span class="error_form">','</span>'); ?>
					<input onblur="verificarCliente(this.value)"  id="Cod" type="text" class="validate" value="<?php echo set_value('codigo'); ?>" name="codigo">
				<?php else:?>
					<input id="Cod" type="text" class="validate" value="<?php echo trim($cliente['CodigoCliente']); ?>" name="codigo">
				<?php endif;?>
				<label for="Cod">Código</label>
			</div>
			<div class="input-field col s6 m2 l2">
				<?php if($opcion == 1): ?>
					<?php echo form_error('RIF'); ?>
					<input id="rif" type="text" class="validate" value="<?php echo set_value('RIF'); ?>" name="rif">
				<?php else:?>
					<input onblur="verificarCliente(this.value)" id="rif" type="text" class="validate" value="<?php echo trim($cliente['RIF']); ?>" name="rif">
				<?php endif;?>
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
							echo form_dropdown('estado',$estados,'');
						}
						else {
							echo form_dropdown('estado',$estados,$cliente['Estado']);
						}
					?>
				<label>Estado</label>
			</div>
			<div class="input-field col s6 m4 l4">
					<?php echo form_error('ciudad'); ?>
					<?
						if($opcion == 1){
							echo form_dropdown('ciudad',$ciudades,'');
						}
						else {
							echo form_dropdown('ciudad',$ciudades,$cliente['Ciudad']);
						}
					?>
				<label>Ciudad</label>
			</div>
			<div class="input-field col s6 m4 l4">
					<?php echo form_error('municipio'); ?>
					<?
						if($opcion == 1){
							echo form_dropdown('municipio',$municipios,'');
						}
						else {
							echo form_dropdown('municipio',$municipios,$cliente['Municipio']);
						}
					?>
				<label>Municipio</label>
			</div>
		</div>
		<button type="submit" class="btn waves-effect waves-light" name="submit"><i class="material-icons right">send</i></button>
	</form>
</div>
</div>
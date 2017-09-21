<select name="tecnico" id="sel_tecnicos_orden">
<?php if(count($tecnicos) == 0): ?>
    <option value="" disabled selected>No hay técnicos para ese servicio</option>
<?php else: ?>
    <option value="" disabled selected>Eliga el técnico</option>
<?php endif; ?>
<?php foreach($tecnicos as $t): ?>
    <option value="<?php echo $t['cedula']; ?>"><?php echo $t['nombre']; ?></option>
<?php endforeach; ?>
	<optgroup label="Acciones">
	    <option value="crear" onclick="console.log('jueves')">Crear técnico</option>
	</optgroup>
</select>
<label>Técnico</label>
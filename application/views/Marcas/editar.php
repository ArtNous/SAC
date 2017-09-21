<div class="container" style="margin-top: 20px;">
	<div class="col s12 m12 l12">
		<?php echo validation_errors(); ?>
		<?php echo form_open('marcas/actualizar'); ?>
		<div class="input-field">
			<div class="form-group">
				<label class="control-label" for="">Nombre de la marca</label>
				<span class="help-block"></span>
				<input type="text" class="form-control" id="campo_nombre_marca" name="nombre" value="<?php echo $marca['nombre']; ?>">
				<input type="text" name="id" value="<?php echo $marca['id']; ?>" style="display: none;">
			</div>
		</div>
		<button type="submit" class="btn">Modificar</button>
		<?php echo form_close(); ?>
	</form>
</div>
</div>
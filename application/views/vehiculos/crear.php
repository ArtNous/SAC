<div class="container">
    <div class="row" style="margin-top: 15px;">
        <h3 class="center">Crear Vehículo</h3>
        <?php echo form_open('vehiculo/crear'); ?>
        <div class="row" id="fila">
            <div class="input-field col s6 m3 l3">
                <?php echo form_error('placa'); ?>
                <i class="prefix material-icons">explicit</i>
                <input id="txtPlaca" type="text" class="validate" name="placa">
                <label for="txtPlaca">Placa</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6 m6 l6">
                <?php echo form_error('marca'); ?>
                <select name="marca" id="comboMarcasVehiculo">
                    <option value="" disabled selected>Elige la marca</option>
                    <?php foreach($marcas as $m): ?>
                        <option value="<?php echo $m['id']; ?>"><?php echo $m['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Marca</label>
            </div>
            <div class="input-field col s6 m6 l6">
                <?php echo form_error('modelo'); ?>
                <select name="modelo" id="comboModelo">
                </select>
                <label>Modelo</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <?php echo form_error('tipov'); ?>
                <select name="tipov">
                  <option value="" disabled selected>Elige el tipo de vehículo</option>
                  <?php foreach($tiposv as $tv): ?>
                  <option value="<?php echo $tv['id']; ?>"><?php echo $tv['descripcion']; ?></option>
                  <?php endforeach; ?>
                </select>
                <label>Tipo de auto</label>
            </div>
        </div>
        <button type="submit" class="btn waves-effect waves-light" name="submit"><i class="material-icons right">send</i></button>
        </form>
    </div>
</div>

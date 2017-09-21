<div class="container">
    <div class="row" style="margin-top: 15px;">
        <?php echo validation_errors(); ?>
        <?php echo form_open('vehiculo/editar/' . $placa); ?>
        <div class="row" id="fila">
            <div class="input-field col s6 m3 l3">
                <i class="prefix material-icons">explicit</i>
                <?php
                    $opc = array(
                        'name' => 'placa',
                        'id' => 'txtUsuario',
                        'value' => $vehiculo['placa'],
                        'class' => 'validate autocomplete',
                    );
                    echo form_input($opc);
                ?>
                <label for="txtUsuario">Placa</label>
            </div>
             <div class="input-field col s6 m3 l3">
                <i class="prefix material-icons">explicit</i>
                <?php
                    $opc = array(
                        'name' => 'km_actual',
                        'id' => 'txtKm',
                        'value' => $vehiculo['km_actual'],
                        'class' => 'validate',
                    );
                    echo form_input($opc);
                ?>
                <label for="txtKm">Kilometraje actual</label>
            </div>
            <div class="input-field col s6 m6 l6">
                <?php
                    foreach ($marcas as $m) {
                        $datos[$m['id']] = $m['nombre'];
                    }
                    echo form_dropdown('marca',$datos,$vehiculo['marca']);
                ?>
                
                <label>Marca</label>
            </div>
            <div class="input-field col s6 m6 l6">
                <?php
                    foreach ($modelos as $m) {
                        $datos[$m['id']] = $m['nombre'];
                    }
                    echo form_dropdown('modelo',$datos,$vehiculo['modelo']);
                ?>
                <label>Modelo</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <?php
                    foreach ($tiposv as $t) {
                        $datos[$t['id']] = $t['descripcion'];
                    }
                    echo form_dropdown('tipov',$datos,$vehiculo['tipo_vehiculo']);
                ?>
                <label>Tipo de auto</label>
            </div>
        </div>
        <button type="submit" class="btn waves-effect waves-light" name="submit"><i class="material-icons right">send</i></button>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="container">
    <div class="row" style="margin-top: 15px;">
        <?php if(isset($tecnico)): ?>
            <h3 class="center">Editar Técnico</h3>
        <?php else: ?>
            <h3 class="center">Crear Técnico</h3>
        <?php endif; ?>
        <?php echo isset($tecnico) ? form_open('tecnicos/crear/' . $tecnico['cedula']) : form_open('tecnicos/crear'); ?>
        <div class="row" id="fila">
            <div class="input-field col s12 m8 l8">
                <?php echo form_error('nombre'); ?>
                <i class="prefix material-icons">account_circle</i>
                <?php
                    $opciones = array(
                        'name' => 'nombre',
                        'id' => 'txtNombreTecnico',
                        'value' => set_value('nombre',isset($tecnico) ? $tecnico['nombre']: ''),
                        'class' => 'validate autocomplete',
                    );
                    echo form_input($opciones);
                ?>
                <!-- <input id="txtNombreTecnico" type="text" class="validate autocomplete" name="nombre"> -->
                <label for="txtNombreTecnico">Nombre</label>
            </div>
            <div class="input-field col s6 m4 l4">
                <?php echo form_error('cedula'); ?>
                <i class="prefix material-icons">visibility</i>
                <?php
                    $opciones = array(
                        'name' => 'cedula',
                        'id' => 'txtCedulaTecnico',
                        'value' => set_value('cedula',isset($tecnico) ? $tecnico['cedula'] : ""),
                        'class' => 'validate',
                    );
                    echo form_input($opciones);
                ?>
                <!-- <input id="txtCedulaTecnico" type="text" class="validate" name="cedula"> -->
                <label for="txtCedulaTecnico">Cédula</label>
            </div>
            <div class="input-field col s6 m3 l3">
                <i class="prefix material-icons">spellcheck</i>
                <?php
                    $opciones = array(
                        'name' => 'codigoINT',
                        'id' => 'txtCodigoINT',
                        'value' => set_value('codigoINT',isset($tecnico) ? $tecnico['codigoINT'] : ""),
                        'class' => 'validate',
                    );
                    echo form_input($opciones);
                ?>
                <!-- <input id="txtCodigoINT" type="text" class="validate" name="codigoINT"> -->
                <label for="txtCodigoINT">Codigo INT</label>
            </div>
            <div class="input-field col s6 m5 l5">
                <?php echo form_error('servicios[]'); ?>
                <div class="input-field col s12">
                    <?php
                        if (isset($tecnico)) {
                            $serv = array();
                            foreach ($tecnico['servicios'] as $s) {
                                $serv[] = $s['servicio'];
                            }
                        }
                        $temp[''] = 'Seleccione los servicios';
                        foreach($servicios as $s){
                            $temp[$s['Codigo']] = $s['Nombre'];
                        }
                        echo form_multiselect('servicios[]',$temp,isset($tecnico) ? $serv : "",'id="multicombo-servicios"');
                    ?>
                    
                    <label>Servicios</label>
                </div>
            </div>
            <div class="switch col s6 m3 l3">
                <label>
                    Inactivo
                    <?php echo form_checkbox('estatus','activo',isset($tecnico) ? $tecnico['estatus'] : true,'id=switch-estatus'); ?>
                    <span class="lever"></span>
                    Activo
                </label>
            </div>
        </div>
        <button type="submit" class="btn waves-effect waves-light" name="submit"><i class="material-icons right">send</i></button>
    </form>
</div>
</div>
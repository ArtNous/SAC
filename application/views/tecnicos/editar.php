<div class="container">
    <div class="row" style="margin-top: 15px;">
        <?php echo validation_errors(); ?>
        <?php echo form_open('tecnicos/editar/' . $tecnico['cedula']); ?>
        <div class="row" id="fila">

            <div class="input-field col s12 m8 l8">
                <i class="prefix material-icons">account_circle</i>
                <?php 
                    $opc = array(
                        'name' => 'nombre',
                        'id' => 'txtNombreTecnico',
                        'class' => 'validate',
                        'value' => $tecnico['nombre'],
                    );
                    echo form_input($opc); 
                ?>
                <label for="txtNombreTecnico">Nombre</label>
            </div>

            <div class="input-field col s6 m4 l4">
                <i class="prefix material-icons">visibility</i>
                <?php 
                    $opc = array(
                        'name' => 'cedula',
                        'id' => 'txtCedulaTecnico',
                        'class' => 'validate',
                        'value' => $tecnico['cedula'],
                    );
                    echo form_input($opc); 
                ?>
                <label for="txtCedulaTecnico">Cédula</label>
            </div>

            <div class="input-field col s6 m6 l6">
                 <i class="prefix material-icons">spellcheck</i>
                 <?php 
                    $opc = array(
                        'name' => 'codigoINT',
                        'id' => 'txtCodigoINT',
                        'class' => 'validate',
                        'value' => $tecnico['codigoINT'],
                    );
                    echo form_input($opc); 
                ?>
                <label for="txtCodigoINT">Codigo INT</label>
            </div>
            <div class="input-field col s6 m5 l5">
                <div class="input-field col s12">
                    <?php
                        $temp[''] = 'Seleccione los servicios';
                        foreach($servicios as $s){
                            $temp[$s['codigo']] = $s['nombre'];
                        }
                        foreach ($servicios_tec as $s) {
                            $sel[] = $s['servicio'];
                        }
                        echo form_multiselect('servicios',$temp,$sel);
                    ?>
                    
                    <label>Servicios</label>
                </div>
            </div>
            <div class="switch col s6 m3 l3">
                <label>
                    Inactivo
                    <?php
                       if($tecnico['estatus'] == 'inactivo'){
                        $opc = array(
                            'name'          => 'estatus',
                            'value'         => 'activo',
                            'checked'       => TRUE,
                            'id'       => 'check-estatus',
                        );
                       } else {
                        $opc = array(
                            'name'          => 'estatus',
                            'value'         => 'inactivo',
                            'checked'       => FALSE,
                            'id'       => 'check-estatus',
                        );
                       }
                       echo form_checkbox($opc);
                    ?>
                    <span class="lever"></span>
                      Activo
                </label>
            </div>
        </div>
        <button type="submit" class="btn waves-effect waves-light"><i class="material-icons right">send</i></button>
        </form>
    </div>
</div>

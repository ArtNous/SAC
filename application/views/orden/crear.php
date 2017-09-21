<div class="container">
    <h3 class="center">Crear Orden de Servicio</h3>
    <?php echo form_open('orden/crear'); ?>
    <div class="row">
        <div class="col s12 m12 l12" id="lblNombreCliente">
        </div>
        <div class="col s12 m12 l12">
            <div class="input-field col s6 m4 l4 campoOrden">
            <?php echo form_error('cliente'); ?>
                <i class="prefix material-icons">account_circle</i>
                <?php  
                    $atributos = array(
                        'name' => 'cliente',
                        'id' => 'txtUsuario',
                        'class' => 'autocomplete',
                        'value' => set_value('cliente'),
                         // Ingrese mas campos aqui
                    );
                    echo form_input($atributos);
                ?>
                <label for="txtUsuario">Código del cliente</label>
            </div>
            <div class="input-field col s6 m4 l4 campoOrden">
                <i class="prefix material-icons">account_circle</i>
                <?php  
                    $atributos = array(
                        'name' => 'cliente_nombre',
                        'id' => 'txtUsuarioNombre',
                        'class' => 'autocomplete',
                        'value' => set_value('cliente_nombre'),
                         // Ingrese mas campos aqui
                    );
                    echo form_input($atributos);
                ?>
                <label for="txtUsuario">Nombre del cliente</label>
            </div>
        </div>
        <div class="col s12 m12 l12">
            <div class="input-field col s12 m4 l4 campoOrden">
                <?php echo form_error('placa'); ?>
                <?php  
                    $atributos = array(
                        'name' => 'placa',
                        'id' => 'txtPlacaOrden',
                        'class' => 'autocomplete',
                        'value' => set_value('placa'),
                         // Ingrese mas campos aqui
                    );
                    echo form_input($atributos);
                ?>
                <label for="txtPlacaOrden">Placa del Vehículo</label>
            </div>
            <div class="col s12 m8 l8" id="nombreVehiculo"></div>
        </div>
        <div class="col s12 m12 l12">
            <div class="input-field col s12 m4 l4 campoOrden">
                <?php echo form_error('servicio'); ?>
                <?php 
                    $opciones[''] = 'Seleccione el servicio';
                    foreach($servicios as $s){
                        $opciones[$s['codigo']] = $s['nombre'];
                    }
                    echo form_dropdown('servicio',$opciones,set_value('servicio'));
                ?>
                <label>Servicio</label>
            </div>

            <div class="input-field col s6 m4 l4 campoOrden">
                <?php echo form_error('km_actual'); ?>
                <i class="prefix material-icons">account_circle</i>
                <?php $atributos = array(
                    'name' => 'km_actual',
                    'id' => 'txtKmActual',
                    'value' => set_value('km_actual'),
                    'class' => 'validate',
                    'type'  => 'number',
                     // Ingrese mas campos aqui
                );
                echo form_input($atributos); ?>
                <label for="txtKmActual">Kilometraje actual</label>
            </div>
        </div>
        <button type="submit" class="btn-floating waves-effect waves-light tooltipped" name="submit" data-position="bottom" data-delay="50" data-tooltip="Agregar orden"><i class="material-icons right">send</i></button>
        <a href="<?php echo base_url('orden'); ?>" class="btn-floating waves-effect waves-light tooltipped" name="submit" data-position="bottom" data-delay="50" data-tooltip="Ver todas"><i class="material-icons right">toc</i></a>
    </form>
</div>
</div>
<div class="container" id="ocupacion-tecnicos">
<div class="row">
    <h3 class="center">Operaciones</h3>
    <div class="col s12 m6 l6">
        <h4 class="center">Cola</h4>
        <?php 
            $opciones[''] = 'Seleccione el servicio';
            foreach($servicios as $s){
                $opciones[$s['codigo']] = $s['nombre'];
            }
            echo form_dropdown('',$opciones,"",'id="select-cola"');
        ?>
        <div id="cola-webix"></div>
        <?php if($this->session->userdata('rol') == 1): ?>
        <button class="btn waves-effect waves-light blue" id="btnActualizarCola" style="margin-top: 5px">Actualizar</button>
        <?php endif; ?>
    </div>
    <div class="col s12 m6 l6">
        <h4 class="center">Activos</h4>
        <?php 
            $opciones[''] = 'Seleccione el servicio';
            foreach($servicios as $s){
                $opciones[$s['codigo']] = $s['nombre'];
            }
            echo form_dropdown('',$opciones,"",'id="select-cola-activos"');
        ?>
        <div id="cola-webix-activos"></div>
    </div>
    <div class="col s12 m12 l12">
        <h3 class="center">Ocupación de Técnicos</h3>
        <div id="ocupacion-tecnicos"></div>
    </div>
    <!-- <div class="col s12 m6 l6">
        <h4 id="cantidad-cola"></h4>
        <p id="tiempoAtencion"></p>
    </div> -->
</div>
</div>
<style>
    #ocupacion-tecnicos h3.center {
        background-color: lightblue;
        padding: 15px;
        border-radius: 4px;
    }

    #ocupacion-tecnicos #cola-webix{
        margin: auto;
    }
</style>
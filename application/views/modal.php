<div id="modal-<?php echo $info['orden']; ?>" class="modal">
	<div class="modal-content">
		<div class="row">
            <div class="col s12 m7 l7">
                <h4><?php echo $cliente['Nombre']; ?></h4>    
            </div>
            <div class="col s12 m5 l5">
                <h6>RIF: <?php echo $cliente['CodigoCliente']; ?></h6>
            </div>            
        </div>
        <div class="row">
            <div class="col s12 m3 l3 center ficha-orden-campo">
                <h6>Tipo de Vehículo</h6>
                <p><?php echo $info['tipo']; ?></p>
            </div>
            <div class="col s12 m3 l3 center ficha-orden-campo">
                <h6>Modelo</h6>
                <?php echo $info['modelo']; ?>
            </div>
            <div class="col s12 m3 l3 center ficha-orden-campo">
                <h6>Marca</h6>
                <?php echo $info['marca']; ?>
            </div>
            <div class="col s12 m3 l3 center ficha-orden-campo">
                <h6>Placa</h6>
                <?php echo $info['placa']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m3 l3">
                Servicio
            </div>
            <div class="col s12 m8 l8">
                <?php echo $info['servicio']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m3 l3">
                Fecha
            </div>
            <div class="col s12 m8 l8">
                <?php echo $info['fecha']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col s4 m3 l3">
                <p style="vertical-align: middle">Técnico</p>
            </div>
            <div class="input-field col s4 m4 l4">
                <?php 
                if($info['estatus'] == 1 && $this->session->userdata('rol') == 1){

                    $opciones[''] = 'Seleccione el tecnico';
                    foreach($tecnicos as $t){
                        $opciones[$t['cedula']] = $t['nombre'];
                    }
                    echo form_dropdown('tecnico',$opciones,$info['tec_ced'],'id="comboTecnicoFicha"');
                } else {
                    echo "<div class='col s12 m8 l8'>"
                        .$info['tecnico']
                        ."</div>";
                }
                ?>
            </div>
            <div class="col s8 m5 l5">
                <?php if($info['estatus'] == 1 && $this->session->userdata('rol') == 1): ?>
                <button style="display: none; vertical-align: middle; margin: 4px 0" class="tooltipped waves-effect waves-green btn-floating green" data-position="bottom" data-delay="50" data-tooltip="Aceptar cambio" id="btnModificarTecnico"><i class="material-icons">check</i>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
		<button class="modal-action modal-close waves-effect waves-green btn-floating tooltipped blue" data-position="bottom" data-delay="50" data-tooltip="Salir"><i class="material-icons">exit_to_app</i></button>
        <!-- Para ver solo administrador -->
        <?php if($info['estatus'] == 2 && $this->session->userdata('rol') == 1): ?>
        </button><button style="float:left" class="tooltipped waves-effect waves-green btn-floating red" data-position="bottom" data-delay="50" data-tooltip="Anular orden" id="btnAnularOrden"><i class="material-icons">cancel</i></button>
        <?php endif;?>
		<!--  -->
		<button class="tooltipped waves-effect waves-green btn-floating link-check green" data-position="bottom" data-delay="50" data-tooltip="Iniciar orden" id="<?php echo $info['placa']; ?>" data-servicio="<?php echo $info['serv']; ?>" data-nro-orden="<?php echo $info['orden']; ?>"><i class="material-icons">send</i></button>
	</div>
</div>
<script>
    if(document.getElementsByClassName('link-check').length == 1) {
            $('.link-check').click(e => {
            
                var nroOrden = e.currentTarget.dataset.nroOrden;
                var servicio = e.currentTarget.dataset.servicio;

                 $$('ix-progreso-tecnicos').attachEvent('onAfterLoad',function(){
                    this.data.each(obj => {
                        if(obj.termino == 1){
                            var opc = {
                                id: 'gage-' + obj.orden,
                                value: obj.tiempo,
                                min: 0,
                                max: obj.tiempo,
                                title: 'Finalizó'
                            }
                        } else {
                            var opc = {
                                id: 'gage-' + obj.orden,
                                value: obj.minutos,
                                min: 0,
                                max: obj.tiempo,
                                title: 'Tiempo'
                            }
                        }
                        var g = new JustGage(opc);
                    });
                });

                $.ajax('<?php echo base_url('orden/iniciarOrden/'); ?>',{
                    type: 'POST',
                    data: {orden: nroOrden, servicio: servicio},
                    dataType: 'text',
                    success: datos => {
                        console.log(datos);
                        if(datos == 1){
                            webix.ajax().post('<?php echo base_url('api/cola') ?>',{servicio: $('#select-cola').val()}, (text_cola,data) => {
                                $('#modal-<?php echo $info['orden']; ?>').modal('close');
                                $$('ix-cola').clearAll();
                                $$('ix-cola').parse(text_cola);

                                webix.ajax().get('api/progreso_activas',(text_pro,data) => {
                                    $$('ix-progreso-tecnicos').clearAll();
                                    $$('ix-progreso-tecnicos').parse(text_pro);
                                    swal('Iniciada','Se inició la orden exitosamente.', 'success');
                                });
                            });
                        } else if (datos == 5) {
                            swal('Ocupados','No hay tecnicos disponibles en este momento. Espere su turno o cierre la orden correspondiente.', 'warning');
                        } else if (datos == 7){
                             webix.ajax().post('<?php echo base_url('api/cola') ?>',{servicio: $('#select-cola').val()}, (text,data) => {
                                $('#modal-<?php echo $info['orden']; ?>').modal('close');
                                $$('ix-cola').clearAll();
                                $$('ix-cola').parse(text);
                                
                                webix.ajax().get('<?php echo base_url('api/progreso_activas'); ?>',(text,data) => {
                                    $$('ix-progreso-tecnicos').clearAll();
                                    $$('ix-progreso-tecnicos').parse(text);
                                    swal('Iniciada','Se inició la orden exitosamente.', 'success');
                                });
                            });
                        } else if (datos == 8) {
                             swal('Un momento','No le toca su turno, espere por favor.', 'warning');
                        } else {
                            
                        }
                    },
                    error: err => {
                        console.log('Error: ' + err);
                    }
                });
            });
        }
</script>
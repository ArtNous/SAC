<div class="container">
    <div class="row" style="margin-top: 15px;">
        <div class="col s12 m3 l3">
            <a href="<?php echo base_url($btnCrearUrl); ?>" class="btn-large btnCrearRegistro">Crear</a>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m6 l6">
            <ul class="collection">
                <?php foreach($filas as $f): ?>
                <li class="collection-item">
                    <div>
                        <?php if (isset($f['nombre'])){
                            echo $f['nombre'];
                            $nombre = $f['nombre'];
                        } elseif (isset($f['descripcion'])) {
                            echo $f['descripcion'];
                            $nombre = $f['descripcion'];
                        } else {
                            echo $f['placa'];
                            $nombre = $f['placa'];
                        }
                        ?>
                            
                        <?php if (isset($f['id']) && $eliminar):?>
                        
                            <a onclick="abrirMdlEliminar('<?php echo $nombre; ?>',<?php echo $f['id']; ?>,'<?php echo base_url($urlEliminar); ?>/')" href="#!" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">clear</i></a>
                        <?php endif;?>
                        <?php if (isset($f['codigo']) && $eliminar):?>
                        
                            <a onclick="abrirMdlEliminar('<?php echo $nombre; ?>','<?php echo $f['codigo']; ?>','<?php echo base_url($urlEliminar); ?>/')" href="#!" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">clear</i></a>
                        
                        <?php endif;?>
                        <?php if (isset($f['cedula']) && $eliminar):?>
                        
                             <a onclick="abrirMdlEliminar('<?php echo $nombre; ?>',<?php echo $f['cedula']; ?>,'<?php echo base_url($urlEliminar); ?>/')" href="#!" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">clear</i></a>

                        <?php endif;?>

                        <?php if (isset($f['placa']) && $eliminar):?>
                        
                             <a onclick="abrirMdlEliminar('<?php echo $nombre; ?>','<?php echo $f['placa']; ?>','<?php echo base_url($urlEliminar); ?>/')" href="#!" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">clear</i></a>

                        <?php endif;?>

                        <!-- Botones editar -->
                        
                        <?php if (isset($f['id']) && $editar): ?>
                            <a href="<?php echo base_url($urlEditar) . $f['id'] ?>" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
                        <?php endif; ?>

                        <?php if (isset($f['codigo']) && $editar): ?>
                            <a href="<?php echo base_url($urlEditar) . $f['codigo'] ?>" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
                        <?php endif; ?>

                        <?php if (isset($f['cedula']) && $editar): ?>
                            <a href="<?php echo base_url($urlEditar) . $f['cedula'] ?>" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
                        <?php endif; ?>

                        <?php if (isset($f['placa']) && $editar): ?>
                            <a href="<?php echo base_url($urlEditar) . $f['placa'] ?>" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
                        <?php endif; ?>
                        <!-- Fin -->

                        <!-- Botones Ver -->
                        <?php if (isset($f['id']) && $ver): ?>
                            <a href="<?php echo base_url($urlVer) . $f['id']; ?>" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Ver"><i class="material-icons">content_paste</i></a>
                        <?php endif; ?>

                        <?php if (isset($f['codigo']) && $ver): ?>
                            <a href="<?php echo base_url($urlVer) . $f['codigo']; ?>" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Ver"><i class="material-icons">content_paste</i></a>
                        <?php endif; ?>

                        <?php if (isset($f['cedula']) && $ver): ?>
                            <a href="<?php echo base_url($urlVer) . $f['cedula']; ?>" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Ver"><i class="material-icons">content_paste</i></a>
                        <?php endif; ?>

                        <?php if (isset($f['placa']) && $ver): ?>
                            <a href="<?php echo base_url($urlVer) . $f['placa']; ?>" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Ver"><i class="material-icons">content_paste</i></a>
                        <?php endif; ?>
                        <!-- Botones Ver -->
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div id="mdlEditar" class="modal">
    <div class="modal-content">
        <h5></h5>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>

<!-- Modal Eliminar -->
<div id="mdlEliminar" class="modal">
    <div class="modal-content">
        <h5></h5>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
        <a href="<?php echo base_url($urlEliminar); ?>" class="modal-action modal-close waves-effect waves-green btn-flat">Si</a>
    </div>
</div>

<!-- Modal Ficha de información -->
<div id="mdlFicha" class="modal">
    <div class="modal-content">
        <h5></h5>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Salir</a>        
    </div>
</div>

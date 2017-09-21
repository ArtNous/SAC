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
            
            <?php if (isset($f['id'])):?>
            
                <a onclick="abrirMdlEliminar('<?php echo $nombre; ?>',<?php echo $f['id']; ?>,'<?php echo base_url($urlEliminar); ?>/')" href="#!" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">clear</i></a>
            <?php endif;?>
            <?php if (isset($f['codigo'])):?>
            
                <a onclick="abrirMdlEliminar('<?php echo $nombre; ?>','<?php echo $f['codigo']; ?>','<?php echo base_url($urlEliminar); ?>/')" href="#!" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">clear</i></a>
            
            <?php endif;?>
            <?php if (isset($f['cedula'])):?>
            
                <a onclick="abrirMdlEliminar('<?php echo $nombre; ?>',<?php echo $f['cedula']; ?>,'<?php echo base_url($urlEliminar); ?>/')" href="#!" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">clear</i></a>
            <?php endif;?>
            <?php if (isset($f['placa'])):?>
            
                <a onclick="abrirMdlEliminar('<?php echo $nombre; ?>','<?php echo $f['placa']; ?>','<?php echo base_url($urlEliminar); ?>/')" href="#!" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Eliminar"><i class="material-icons">clear</i></a>
            <?php endif;?>
            
            <a href="<?php echo base_url('orden/editar/') . $f['placa']; ?>" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a>
            <a href="<?php echo base_url('orden/ficha/') . $f['nro_orden']; ?>" class="tooltipped secondary-content" data-position="bottom" data-delay="50" data-tooltip="Ver"><i class="material-icons">content_paste</i></a>
        </div>
    </li>
    <?php endforeach; ?>
</ul>

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
<div class="container">
    <div class="row">
        <div class="col s12 m12 l12" style="margin: 10px 30px">
            <h3 class="center">Lista de Vehículos</h3>
            <div id="lista-vehiculos-webix"></div>
            <div id="paginador" style="width: 40%"></div>   
        </div>
        <div class="col s12 m12 l12" style="margin: 10px 30px">
            <a href="<?php echo base_url('vehiculo/crear'); ?>" class="btn-floating tooltipped waves-effect waves-light green" data-position="bottom" data-tooltip="Crear Vehículo" data-delay="50"><i class="material-icons">add</i></a>
            <a href="" class="btn-floating tooltipped waves-effect waves-light green " style="display: none" id="btnModificar" data-position="bottom" data-tooltip="Editar Vehículo" data-delay="50"><i class="material-icons blue">edit</i></a>
            <a href="" class="btn-floating tooltipped waves-effect waves-light green" style="display: none" id="btnEliminar" data-position="bottom" data-tooltip="Eliminar Vehículo" data-delay="50"><i class="material-icons red">clear</i></a>
        </div>
    </div>
</div>

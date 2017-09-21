<div class="container">
    <div class="row">
        <div class="col s12 m12 l12" style="margin: 10px 30px">
            <h3 class="center">Lista de Ordenes de Servicio</h3>
            <div id="lista-ordenes-webix"></div>
            <div id="paginador" style="width: 40%"></div>   
        </div>
        <div class="col s12 m12 l12" style="margin: 10px 30px">
            <a href="<?php echo base_url('orden/crear'); ?>" class="btn-floating waves-light waves-effect green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Crear Orden"><i class="material-icons">add</i></a>
            <button id="btnExportarExcel" class="btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Exportar a Excel"><i class="material-icons">description</i></button>
            <button id="btnExportarPDF" class="btn-floating waves-effect waves-light blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Exportar a PDF"><i class="material-icons">content_paste</i></button>
            <a href="" class="btn-floating waves-effect waves-light" style="display: none" id="btnModificar"><i class="material-icons left">edit</i>Modificar</a>
            <a href="" class="btn-floating red waves-effect waves-light" style="display: none" id="btnEliminar"><i class="material-icons left">clear</i>Eliminar</a>
        </div>
    </div>
</div>

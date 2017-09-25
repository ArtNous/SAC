<div class="container">
   <div class="row">
      <?php foreach($servicios as $servicio): ?>
      <div class="col s12 m3 l3">
         <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
               <img class="activator" src="<?php echo base_url('assets/img/servicios.jpg'); ?>">
            </div>
            <div class="card-content">
               <span class="card-title activator grey-text text-darken-4"><?php echo $servicio['nombre']; ?><i class="material-icons right">more_vert</i></span>
               <p><a href="#">Crear orden</a></p>
            </div>
            <div class="card-reveal">
               <span class="card-title grey-text text-darken-4"><?php echo $servicio['nombre']; ?><i class="material-icons right">close</i></span>
               <p><?php echo $servicio['descripcion']; ?>.</p>
               <a class="btn-floating waves-effect waves-light red" id=""><i class="material-icons">create</i></a>
               <a href="#modal-<?php echo $servicio['codigo']; ?>" class="modal-trigger btn-floating waves-effect waves-light red" id=""><i class="material-icons" ">clear</i></a>
            </div>
         </div>
      </div>
      <!-- Modal Structure -->
      <div id="modal-<?php echo $servicio['codigo']; ?>" class="modal">
         <div class="modal-content">
            <h4>Eliminar servicio</h4>
            <p>¿Esta seguro que desea borrar el servicio <?php echo $servicio['nombre']; ?>?</p>
         </div>
         <div class="modal-footer">
            <a href="<?php echo base_url('index.php/servicios/eliminar/'.$servicio['codigo']); ?>" class="modal-action modal-close waves-effect waves-green btn-flat">Si</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
         </div>
      </div>
      <?php endforeach; ?>
   </div>
</div>
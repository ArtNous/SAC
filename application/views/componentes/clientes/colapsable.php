<div class="container">
  <div class="row center">
    <h4>Listado de clientes</h4>
    <div class="col s12 m12 l12">
      <ul class="collapsible" data-collapsible="accordion">
        <?php foreach($clientes as $cliente):?>
        <li>
          <div class="collapsible-header"><i class="material-icons"><?php echo $icono; ?></i><?php echo $cliente->RIF;?></div>
          <div class="collapsible-body center">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <span class="card-title"><?php echo $cliente->Nombre; ?></span>
                <p>Dirección: <?php echo $cliente->Direccion;?></p>
              </div>
              <div class="card-action">
                <a href="#">Crear orden de servicio</a>
                <a href="#">Ver estadisticas</a>
              </div>
            </div>
          </div>
        </li>
        <?php endforeach;?>
      </ul>
    </div>
    <ul class="pagination">
      <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
      <li class="active"><a href="#!">1</a></li>
      <li class="waves-effect"><a href="#!">2</a></li>
      <li class="waves-effect"><a href="#!">3</a></li>
      <li class="waves-effect"><a href="#!">4</a></li>
      <li class="waves-effect"><a href="#!">5</a></li>
      <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
    </ul>
  </div>
</div>
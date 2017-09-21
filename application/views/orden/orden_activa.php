<?php foreach($ordenes as $o): ?>
<div class="orden_activa" style="width: <?php echo $o['tiempo']; ?>">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title"><b>Orden nro: </b><?php echo $o['nro_orden']; ?></span>
              <ul>
                  <li>Placa: <?php echo $o['placa']; ?></li>
              </ul>
            </div>
            <div class="card-action">
              <a href="#!">Link</a>
              <a href="#">Link</a>
            </div>
          </div>
        </div>
<?php endforeach; ?>
<style>

    .orden_activa{
        float:left;
    }
    .barra-progreso{
        position: relative;
        width: 100%;
        height: 15px;
        background-color: gray;
        border-radius: 0 3px 0 3px;
        box-shadow: 1px 1px 8px rgba(10,10,10,0.4);
    }
    
    .barra-progreso .total {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        background: -webkit-linear-gradient(white, lightskyblue); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(white, lightskyblue); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(white, lightskyblue); /* For Firefox 3.6 to 15 */
        background: linear-gradient(white, lightskyblue); /* Standard syntax */
        width: 30%;
    }
    .barra-progreso span {
        position: absolute;
        top: 15px;
    }

    .barra-progreso span:last-child {
        right: 2px;
    }
</style>
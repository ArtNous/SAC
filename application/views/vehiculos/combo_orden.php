<option value="" disabled selected>
    Elige la placa</option>
<?php foreach($vehiculos as $v): ?>
<option value="<?php echo $v['placa']; ?>">
    <?php echo $v['placa']; ?>
</option>
<?php endforeach; ?>

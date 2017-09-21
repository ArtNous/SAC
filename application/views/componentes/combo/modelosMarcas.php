<option value="" disabled selected>
    Elige el modelo</option>
<?php foreach($modelos as $m): ?>
<option value="<?php echo $m['id']; ?>">
    <?php echo $m['nombre']; ?>
</option>
<?php endforeach; ?>

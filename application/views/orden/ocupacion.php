<?php foreach($tecnicos as $t): ?>
<div class="row">
    <div class="col s4 m2 l2">
        <h4><?php echo $tecnico['nombre']; ?></h4>
    </div>
    <div class="col s8 m10 l10">
        <?php foreach($t['ordenes'] as $o): ?>
            <div class="orden" width="<?php echo $o['tiempo']; ?>" height="40"></div>
        <?php endforeach; ?>
    </div>
</div>
<?php endforeach; ?>
<?php if($orden['estatus'] == "activa"): ?>
<style>
    .orden {
        background-color: lightgreen;
        float: left;
    }
    </style>
<?php else: ?>
<style>
    .orden {
        background-color: orange;
        float: left;
    }
</style>
<?php endif; ?>
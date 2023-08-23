<?php

$classname = ($infos['heroHit'])?'info text-end':'danger';

?>

<div class="text-<?= $classname ?> row border-bottom mx-auto my-3">
    <div class="col-12">
        <p><?= $infos['status'] ?></p>
        <p class="fw-bold"><?= $infos['state'] ?></p>
    </div>
</div>

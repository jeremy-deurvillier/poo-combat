<?php

$classname = ($infos['heroHit'])?'info':'danger';

?>

<div class="text-<?= $classname ?>">
    <p><?= $infos['status'] ?></p>
    <p class="fw-bold"><?= $infos['state'] ?></p>
</div>

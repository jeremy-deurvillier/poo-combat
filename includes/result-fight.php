<?php

$classname = ($infos['result']['heroHit'])?'info':'danger';

?>

<div class="text-<?= $classname ?>">
    <p><?= $infos['result']['status'] ?></p>
    <p class="fw-bold"><?= $infos['result']['state'] ?></p>
</div>

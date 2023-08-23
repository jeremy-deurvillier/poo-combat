<?php

$classname = ($infos['heroHit'])?'info text-end':'danger';

?>

<div class="text-<?= $classname ?> w-50 border-bottom mx-auto my-3">
    <p><?= $infos['status'] ?></p>
    <p class="fw-bold"><?= $infos['state'] ?></p>
</div>

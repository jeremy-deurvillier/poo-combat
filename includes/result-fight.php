<?php

$classname = ($infos['result']['victory'])?'success':'body-tertiary';

?>

<div class="text-<?= $classname ?> text-center row mx-auto my-5">
    <div class="col-12">
        <p class="fs-4 my-4"><?= $infos['result']['status'] ?></p>
        <p class="fs-2 fw-bold border p-4"><?= $infos['result']['state'] ?></p>
    </div>
</div>

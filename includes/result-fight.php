<?php

$classname = ($infos['result']['heroHit'])?'body-tertiary':'success';

?>

<div class="text-<?= $classname ?> text-center w-50 mx-auto my-5">
    <p class="fs-4 my-4"><?= $infos['result']['status'] ?></p>
    <p class="fs-2 fw-bold border p-4"><?= $infos['result']['state'] ?></p>
</div>

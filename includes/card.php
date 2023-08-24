<div class="col-10 col-sm-5 col-lg-3 col-xxl-2 border border-1 p-5 m-2 mx-auto">
    <div class="bg-dark rounded-circle mx-auto mb-1" style="width:64px;height:64px;"></div>
    <div class="text-center py-5">
    <p><?= $hero->getName() ?></p>
    <p><?= $hero->getClass() ?></p>
    <p>HP : <?= $hero->getHp() ?></p>
    </div>
    <form action="fight.php" method="get" class="text-center">
    <input type="hidden" name="hero" value="<?= $hero->getId() ?>" hidden>
        <button type="submit" class="btn btn-primary">Choisir</button>
    </form>
</div>

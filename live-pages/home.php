<?php
function getAllHeroes()
{
  $heroManager = new HeroesManager(dbConnect());

  return $heroManager->findAll();
}

?>

<section class="container-sm container-md">
  <div class="row flex-column flex-sm-row justify-content-center align-items-center">
    <?php foreach(getAllHeroes() as $hero) { ?>
    <div class="col-10 col-sm-5 col-md-4 col-lg-3 col-xl-2 my-3">
      <div class="card text-center">
        <div class="card-header"><?= $hero->getClass() ?></div>
        <div class="card-body">
          <h5 class="card-title"><?= $hero->getName() ?></h5>
          <p class="card-text">PV : <?= $hero->getHp() ?></p>
          <p class="card-text">Energie : <?= $hero->getEnergy() ?></p>
        </div>
        <div class="card-footer text-body-secondary">
          <?php if ($hero->getHp() > 0) { ?>
            <a href="live.php?page=fight&hero=<?= $hero->getId() ?>" class="btn btn-danger">Combattre</a>
          <?php } else { ?>
            <a href="live.php?page=invoke&hero=<?= $hero->getId() ?>" class="btn btn-success">Invoquer</a>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</section>

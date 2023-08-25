<?php
function getAllHeroes()
{
  $heroManager = new HeroesManager(dbConnect());

  return $heroManager->findAll();
}

function currentInvoked(Hero $hero):bool
{
  if ($hero !== null) {
    $invokedDate = $hero->getInvoked();

    if ($invokedDate !== null) {
      if (date('U') > date('U', strtotime($invokedDate))) {
        return false;
      } else {
        return true;
      }
    }
  }

  return false;
}

function timer(Hero $hero):string
{
  $time = date('U', strtotime($hero->getInvoked())) - date('U');

  return date('i:s', $time);
}

function precondition() {
    if (isset($_GET['precondition']) && !empty($_GET['precondition'])) {
        if (isset($_GET['hero']) && !empty($_GET['hero'])) {
            $heroManager = new HeroesManager(dbConnect());

            $heroManager->conditioning(htmlspecialchars($_GET['hero']));
        }
    }
}

precondition();

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
            <?php if ($hero->getInvoked() === null) { ?>
              <a href="live.php?page=invoke&hero=<?= $hero->getId() ?>" class="btn btn-success">Invoquer</a>
            <?php } else { ?>
              <?php if (currentInvoked($hero)) { ?>
                <button class="btn btn-outline-secondary" data-summon="<?= timer($hero) ?>" data-hero="<?= $hero->getId() ?>"><?= timer($hero); ?></button>
              <?php } else { ?>
                <a href="live.php?precondition=true&hero=<?= $hero->getId() ?>" class="btn btn-success">Conditionner</a>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</section>

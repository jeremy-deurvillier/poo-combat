<?php
function getHero():array
{
  if (isset($_GET['hero']) && !empty($_GET['hero'])) {
    $heroManager = new HeroesManager(dbConnect());
    $hero = $heroManager->find(htmlspecialchars($_GET['hero']));

    if ($hero) {
      return [
        'status' => 200,
        'hero' => $hero
      ];
    } else {
      return [
        'status' => 404,
        'message' => 'Ce héro ne semble pas exister.'
      ];
    }
  } else {
    return [
      'status' => 403,
      'message' => 'Cette erreur s\'est produite ! :)'
    ];
  }
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

function invokeHero()
{
  if (isset($_GET['invoked']) && !empty($_GET['invoked'])) {
    if (isset($_GET['hero']) && !empty($_GET['hero'])) {
      $heroManager = new HeroesManager(dbConnect());
      $heroManager->invoke(htmlspecialchars($_GET['hero']));
    }
  }
}

function timer(Hero $hero):string
{
  $time = date('U', strtotime($hero->getInvoked())) - date('U');

  return date('i:s', $time);
}

invokeHero();

$data = getHero();
$hero = ($data['status'] === 200)?$data['hero']:null;

$isCurrentInvoked = currentInvoked($hero);

?>

<section class="container-sm container-md">
  <div class="row flex-column flex-sm-row justify-content-center align-items-center">
    <?php if ($hero !== null) { ?>
    <div class="col-10 col-sm-8 col-md-6 col-lg-4 my-3">
      <div class="card text-center">
        <div class="card-header"><?= $hero->getName() ?></div>
        <div class="card-body">
          <h5 class="card-title">Invoquer un Héro ?</h5>
          <p class="card-text">Voulez-vous vraiment réssusciter <?= $hero->getName() ?> d'entre les morts ?</p>
          <p class="card-text">Invoquer un Héro prends du temps. Continuer ?</p>
        </div>
        <div class="card-footer text-body-secondary">
          <?php if (!$isCurrentInvoked) { ?>
            <a href="live.php?page=invoke&hero=<?= $hero->getId() ?>&invoked=true" class="btn btn-success">Invoquer</a>
          <?php } else { ?>
            <button class="btn btn-outline-secondary" data-summon="<?= timer($hero) ?>" data-hero="<?= $hero->getId() ?>"><?= timer($hero); ?></button>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } else { ?>
    <div class="text-center bg-warning p-4">
      <p><?= $data['message'] ?></p>
      <p><a href="live.php" class="btn btn-outline-secondary">Retour</a></p>
    </div>
    <?php } ?>
  </div>
</section>

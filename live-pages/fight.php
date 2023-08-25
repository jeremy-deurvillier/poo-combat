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

function getMonster():array
{
    $fightManager = new FightManager();
    $monster = $fightManager->createMonster();

    if ($monster) {
        return [
            'status' => 200,
            'monster' => $monster
        ];
    } else {
        return [
            'status' => 404,
            'message' => 'Ce monstre ne semble pas exister.'
        ];
    }
}

function startFight($monster, $hero) {
    $fightManager = new FightManager();
    $damage = $monster->hit($hero);
    $step = $fightManager->getStep($monster, $damage, $hero);

    return $step;
}

$heroData = getHero();
$monsterData = getMonster();

$hero = ($heroData['status'] === 200)?$heroData['hero']:null;
$monster = ($monsterData['status'] === 200)?$monsterData['monster']:null;

?>

<section class="container-sm container-md">
  <div class="row flex-column flex-column justify-content-center align-items-center">
    <?php if ($hero !== null && $monster !== null) { ?>
        <!-- Hero -->
        <div class="col-4 my-3">
          <div class="card text-center">
            <div class="card-header"><?= $hero->getClass() ?></div>
            <div class="card-body">
              <h5 class="card-title"><?= $hero->getName() ?></h5>
              <p class="card-text">PV : <?= $hero->getHp() ?></p>
              <p class="card-text">Energie : <?= $hero->getEnergy() ?></p>
            </div>
          </div>
        </div>

        <p class="text-center fw-bold text-danger">VS</p>

        <!-- Monster -->
        <div class="col-4 my-3">
          <div class="card text-center">
            <div class="card-header"><?= $monster->getClass() ?></div>
            <div class="card-body">
              <h5 class="card-title"><?= $monster->getName() ?></h5>
              <p class="card-text">PV : <?= $hero->getHp() ?></p>
              <br />
            </div>
          </div>
     
    <?php } else { ?>
    <div class="text-center bg-warning p-4">
      <p><?= (isset($heroData['message']))?$heroData['message']:$monsterData['message'] ?></p>
      <p><a href="live.php" class="btn btn-outline-secondary">Retour</a></p>
    </div>
    <?php } ?>
  </div>
</section>

<!-- Fight section -->

<?php if ($hero !== null && $monster !== null) { ?>
    <section class="container-sm container-md">
        <?php $infos = startFight($monster, $hero) ?>
        <p><?= $infos['status'] ?></p>
        <p><?= $infos['state'] ?></p>
        <div id="userActions" class="text-center">
            <a href="#" class="btn btn-primary btn-lg" data-action="hit">Hit</a>
            <a href="#" class="btn btn-secondary btn-lg" data-action="special">Special Hit</a>
            <a href="#" class="btn btn-success btn-lg" data-action="run">Run</a>
        </div>
    </section>

    <script>
        function getDatasFight() {
            let hero = {
                'id_hero': <?= $hero->getId() ?>,
                'name': '<?= $hero->getName() ?>',
                'class': '<?= $hero->getClass() ?>',
                'hp': <?= $hero->getHp() ?>,
                'energy': <?= $hero->getEnergy() ?>,
                'last_summon': '<?= $hero->getInvoked() ?>'
            };

            let monster = {
                'name': '<?= $monster->getName() ?>',
                'class': '<?= $monster->getClass() ?>',
                'hp': <?= $monster->getHp() ?>
            };

            return {
                'hero': hero,
                'monster': monster
            };
        }
    </script>
<?php } ?>

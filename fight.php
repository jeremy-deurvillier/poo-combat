<?php

require_once('config/autoload.php');
require_once('config/db-connect.php');

$title = 'Fight !';

include('includes/header.php');

function alert(array $alert) {
    include('includes/alert.php');
}

function fighting() {
    if (isset($_GET['hero'])) {
        if (!empty($_GET['hero'])) {
            $heroManager = new HeroesManager(dbConnect());
            $fightManager = new FightManager();

            $hero = $heroManager->find(htmlspecialchars($_GET['hero']));
            $monster = $fightManager->createMonster();

            if ($hero && $hero->getHp() > 0) {
                $resultFight = $fightManager->fight($hero, $monster);

                foreach ($resultFight as $infos) {
                    if (!isset($infos['result'])) {
                        include('includes/step-fight.php');
                    } else {
                        include('includes/result-fight.php');
                    }
                }

                $heroManager->update($hero);
            } else {
                include('includes/hero-no-hp.php');
            }

        } else {
            alert([
                'classname' => 'warning',
                'text' => 'Il y a des paramètres vides dans l\'URL !'
            ]);
        }
    } else {
        alert([
            'classname' => 'warning',
            'text' => 'Il manque un paramètre dans l\'URL !'
        ]);
    }
}

?>

<h2 class="text-center my-5">Fighting !</h2>

<div class="position-fixed mb-5 px-3">
    <a href="/" class="btn btn-primary mb-3">Retour</a>
</div>

<section class="container">
    <?php fighting(); ?>
</section>

<?php include('includes/footer.php'); ?>

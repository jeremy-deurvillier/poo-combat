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

<?php include('includes/home-btn.php'); ?>

<section class="container-sm container-md">
    <?php fighting(); ?>
</section>

<?php

include('includes/home-btn.php');
include('includes/footer.php');

?>

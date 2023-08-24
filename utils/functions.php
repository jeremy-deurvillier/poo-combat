<?php

function alert(array $alert) {
    include('includes/alert.php');
}

function createHero() {
    if (isset($_POST['name']) && isset($_POST['class'])) {
        if (!empty($_POST['name'])) {
            if (!empty($_POST['class'])) {
                $manager = new HeroesManager(dbConnect());

                $heroProps = [
                    'name' => htmlspecialchars($_POST['name']),
                    'class' => htmlspecialchars($_POST['class'])
                ];

                $class = ucfirst($heroProps['class']);
                $hero = new $class($heroProps);

                $heroIsCreated = $manager->add($hero);

                if ($heroIsCreated) {
                    alert([
                        'classname' => 'success',
                        'text' => 'Héro créé avec succès !'
                    ]);
                } else {
                    alert([
                        'classname' => 'warning',
                        'text' => 'Une erreur est survenue.'
                    ]);
                }
            } else {
                alert([
                    'classname' => 'info',
                    'text' => 'Votre héro doit avoir une classe valide.'
                ]);
            }
        } else {
            alert([
                'classname' => 'info',
                'text' => 'Votre héro doit avoir un nom.'
            ]);
        }
    }
}

function showHeroesAlive() {
    $manager = new HeroesManager(dbConnect());
    $heroes = $manager->findAllAlive();

    if (count($heroes) > 0) {
        foreach ($heroes as $hero) {
            include('includes/card.php');
        }
    } else {
        include('includes/no-hero.php');
    }
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

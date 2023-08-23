<?php

require_once('config/autoload.php');
require_once('config/db-connect.php');

$title = 'Accueil';

include('includes/header.php');

function alert(array $alert) {
    include('includes/alert.php');
}

function createHero() {
    if (isset($_POST['name'])) {
        if (!empty($_POST['name'])) {
            $manager = new HeroesManager(dbConnect());

            $heroProps = [
                'name' => htmlspecialchars($_POST['name'])
            ];

            $hero = new Hero($heroProps);

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

?>

    <h2 class="text-center my-5">Nouveau héro</h2>
    <?php createHero(); ?>
    <form method="post" action="/" class="row justify-content-center g-3 m-4">
        <div class="col-auto">
            <label for="name" class="visually-hidden">Nom de votre héro :</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom du héro">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Créer</button>
        </div>
    </form>

    <h2 class="text-center my-5">Liste des héros</h2>
    <section class="row justify-content-center g-3 vw-100 mb-4">
        <?php showHeroesAlive(); ?> 
    </section>

<?php include('includes/footer.php'); ?>

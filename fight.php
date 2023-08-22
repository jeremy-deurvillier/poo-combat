<?php

require_once('config/autoload.php');
require_once('config/db-connect.php');

$title = 'Fight !';

include('includes/header.php');

function alert(array $alert) {
    include('includes/alert.php');
}

function findHero() {
    if (isset($_GET['hero'])) {
        if (!empty($_GET['hero'])) {
            $manager = new HeroesManager(dbConnect());

            $hero = $manager->find(htmlspecialchars($_GET['hero']));

            if ($hero) {
                include('includes/card.php');
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

<div class="mb-5 px-3">
    <a href="/" class="btn btn-primary mb-3">Retour</a>
</div>
FIGHT !

<?php findHero(); ?>

<?php include('includes/footer.php'); ?>

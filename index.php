<?php

require_once('config/autoload.php');
require_once('config/db-connect.php');
require_once('utils/functions.php');

$title = 'Accueil';

include('includes/header.php');

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
<section class="row flex-column flex-sm-row justify-content-center g-3 vw-100 mb-4">
    <?php showHeroesAlive(); ?> 
</section>

<?php include('includes/footer.php'); ?>

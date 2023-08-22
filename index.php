<?php

require_once('config/autoload.php');

$title = 'Accueil';

include('includes/header.php');

?>

    <h2 class="text-center my-5">Nouveau héro</h2>
    <form method="post" action="/" class="row justify-content-center g-3 m-4">
        <div class="col-auto">
            <label for="name" class="visually-hidden">Nom de votre héro :</label>
            <input type="text" class="form-control" id="name" placeholder="Nom du héro">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Créer</button>
        </div>
    </form>

    <h2 class="text-center my-5">Liste des héros</h2>
    <section class="row justify-content-center g-3 vw-100">
        
    </section>

<?php include('includes/footer.php'); ?>

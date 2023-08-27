<?php

require_once('config/autoload.php');
require_once('config/db-connect.php');
require_once('utils/functions.php');

$title = 'Fight !';

include('includes/header.php');

?>

<h2 class="text-center my-5">Fighting !</h2>

<?php include('includes/home-btn.php'); ?>

<section id="fightHistory" class="container-sm container-md">
    <?php fighting(); ?>
</section>

<?php

include('includes/home-btn.php');
include('includes/footer.php');

?>

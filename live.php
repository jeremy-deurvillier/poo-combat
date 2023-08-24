<?php

require_once('config/autoload.php');
require_once('config/db-connect.php');
require_once('utils/functions.php');

$title = 'Live Fight !';

include('includes/header.php');

?>

<h2 class="text-center my-5">Live Fight</h2>

<?php

function routes()
{
  if (!isset($_GET['page']))
  {
    include('live-pages/home.php');
  } else {
    switch ($_GET['page']) {
      case 'fight':
        include('live-pages/fight.php');
        break;
      case 'invoke':
        include('live-pages/invoke.php');
        break;
      default:
        include('live-pages/404.php');
    }
  }
}

routes();

?>

<?php include('includes/footer.php'); ?>

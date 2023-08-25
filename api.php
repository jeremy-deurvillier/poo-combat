<?php

require_once('config/autoload.php');
require_once('config/db-connect.php');

function fight() {
    $datas = json_decode($_GET['datas']);

    $heroData = $datas['hero'];
    $monsterData = $datas['monster'];

    $hero = new Hero($heroData);
    $monster = new Monster($monsterData);
    $fightManager = new FightManager();

    $damage = $hero->hit($monster);
    $step = $fightManager->getStep($hero, $damage, $monster);

    echo json_encode($step);

} 

fight();

?>

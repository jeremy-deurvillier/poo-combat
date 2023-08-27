<?php

require_once('config/autoload.php');
require_once('config/db-connect.php');

function getDamage($atk, string $action, $def) {
    $actionsAvailables = ['hit', 'special', 'run'];

    if (in_array($action, $actionsAvailables, true)) {
        switch($action) {
        case 'hit':
            return $atk->hit($def);
            break;
        case 'special':
            return $atk->specialHit($def);
            break;
        case 'run':
            $atk->run();
            return 'running';
            break;
        }
    }
}

function fight() {
    $actionIsOk = isset($_GET['action']) && !empty($_GET['action']);
    $heroIsOk = isset($_GET['hero']) && !empty($_GET['hero']);
    $monsterIsOk = isset($_GET['monster']) && !empty($_GET['monster']);
    $hpIsOk = isset($_GET['hp']) && !empty($_GET['hp']);

    if ($actionIsOk && $heroIsOk && $monsterIsOk && $hpIsOk) {
        $monsterData = [
            'name' => htmlspecialchars($_GET['monster']),
            'hp' => htmlspecialchars($_GET['hp'])
        ];

        $result = [];
        $heroManager = new HeroesManager(dbConnect());
        $hero = $heroManager->find(htmlspecialchars($_GET['hero']));
        $monster = new Monster($monsterData);
        $fightManager = new FightManager();

        $damageHero = getDamage($hero, htmlspecialchars($_GET['action']), $monster);

        if ($damageHero === 'running') {
            $result = [
                'result' => [
                    'victory' => false,
                    'status' => $hero->getName() . ' a fuit.',
                    'state' => 'Défaite'
                ]
            ];

            return json_encode(['steps' => [], 'result' => $result]);
        } else {
            $stepHero = $fightManager->getStep($hero, $damageHero, $monster);

            $damageMonster = $monster->hit($hero);
            $stepMonster = $fightManager->getStep($monster, $damageMonster, $hero);

            $heroManager->update($hero);

            if ($monster->getHp() == 0 || $hero->getHp() == 0) {
                $winner = $fightManager->getWinner($hero, $monster);
                $result = $fightManager->getResult($winner);
            }
        }

        return json_encode(['steps' => [$stepHero, $stepMonster], 'result' => $result, 'hpM' => $monster->getHp()]);
    }

} 

echo fight();

?>

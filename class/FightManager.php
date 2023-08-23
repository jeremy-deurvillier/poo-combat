<?php

class FightManager {

    public function __construct() {}

    public function createMonster():Monster
    {
        return new Monster([
            'name' => 'Freezer',
            'hp' => 100
        ]);
    }

    function createHistory(Hero $hero, Monster $monster, array &$history, bool $heroHit = false):array
    {
        if ($hero->getHp() > 0 && $monster->getHp() > 0) {

            if ($heroHit) {
                $damage = $hero->hit($monster);
                $status = $hero->getName() . ' inflige ' . $damage . ' dégats à ' . $monster->getName() . '.';
                $state = $monster->getName() . ' a maintenant ' . $monster->getHp() . ' PV.';
            } else {
                $damage = $monster->hit($hero);
                $status = $monster->getName() . ' inflige ' . $damage . ' dégats à ' . $hero->getName() . '.';
                $state = $hero->getName() . ' a maintenant ' . $hero->getHp() . ' PV.';
            }

            $history[] = [
                'heroHit' => $heroHit,
                'status' => $status,
                'state' => $state
            ];

            $heroHit = !$heroHit;

            $this->createHistory($hero, $monster, $history, $heroHit);
        }

        return $history;
    }

    function getWinner(Hero $hero, Monster $monster) {
        if ($hero->getHp() > 0) return $hero;

        return $monster;
    }

    function getResult($winner):array
    {
        if (get_class($winner) == 'Hero') {
            $status = 'Avec courage, vous avez terrasser l\'ennemi.';
            $state = 'Victoire';
            $isVictory = true;
        } else {
            $status = 'Votre héro n\'a pas été à la hauteur.';
            $state = 'Défaite';
            $isVictory = false;
        }

        return [
            'result' => [
                'victory' => $isVictory,
                'status' => $status,
                'state' => $state
            ]
        ];
    }

    public function fight(Hero $hero, Monster $monster):array
    {
        $fightHistory = [];

        $fightHistory = $this->createHistory($hero, $monster, $fightHistory);

        $winner = $this->getWinner($hero, $monster);
        
        $result = $this->getResult($winner);

        $fightHistory[] = $result;

        return $fightHistory;
    }

}

?>

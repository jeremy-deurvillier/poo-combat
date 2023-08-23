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

    function defineWinner(Hero $hero, Monster $monster) {
        if ($hero->getHp() > 0) return $hero;

        return $monster;
    }

    public function fight(Hero $hero, Monster $monster):array
    {
        $fightHistory = [];
        $heroHit = false;
        $status = '';
        $state = '';
        
        while ($hero->getHp() > 0 && $monster->getHp() > 0) {

            if ($heroHit) {
                $damage = $hero->hit($monster);
                $status = $hero->getName() . ' inflige ' . $damage . ' dégats à ' . $monster->getName() . '.';
                $state = $monster->getName() . ' a maintenant ' . $monster->getHp() . 'PV.';
            } else {
                $damage = $monster->hit($hero);
                $status = $monster->getName() . ' inflige ' . $damage . ' dégats à ' . $hero->getName() . '.';
                $state = $hero->getName() . ' a maintenant ' . $hero->getHp() . 'PV.';
            }

            $fightHistory[] = [
                'heroHit' => $heroHit,
                'status' => $status,
                'state' => $state
            ];

            $heroHit = !$heroHit;
        }

        $winner = $this->defineWinner($hero, $monster);

        if (get_class($winner) == 'Hero') {
            $status = 'Avec courage, vous avez terrasser l\'ennemi.';
            $state = 'Victoire';
        } else {
            $status = 'Votre héro n\'a pas été à la hauteur.';
            $state = 'Défaite';
        }

        $fightHistory[] = [
            'result' => [
                'heroHit' => $heroHit,
                'status' => $status,
                'state' => $state
            ]
        ];

        return $fightHistory;
    }

}

?>

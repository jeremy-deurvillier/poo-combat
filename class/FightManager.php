<?php

class FightManager {

    public function __construct() {}

    public function createMonster():Monster
    {
        $names = ['Sala Mee', 'Belordur', 'Cass Coui'];
        $class = ['ogre', 'sorcier', 'fantassin'];

        return new Monster([
            'name' => $names[rand(0, count($names) - 1)],
            'hp' => 100,
            'class' => $class[rand(0, count($class) - 1)]
        ]);
    }

    function getStep($atk, int $damage, $def):array
    {
        $status = $atk->getName() . ' inflige ' . $damage . ' dégats à ' . $def->getName() . '.';
        $state = $def->getName() . ' a maintenant ' . $def->getHp() . ' PV.';

        return [
            'status' => $status,
            'state' => $state
        ];
    }

    function createHistory(Hero $hero, Monster $monster, array &$history, bool $heroHit = false):array
    {
        if ($hero->getHp() > 0 && $monster->getHp() > 0) {

            if ($heroHit) {

                if ($hero->getEnergy() >= Hero::COST_HIT) {
                    $damage = $hero->hit($monster);
                    $step = $this->getStep($hero, $damage, $monster);
                } else {
                    $step = [
                        'status' => $hero->getName() . ' ne peut pas attaquer ' . $monster->getName() . '.',
                        'state' => $hero->getName() . ' n\'a plus que ' . $hero->getEnergy() . ' ENG.'
                    ];
                }

            } else {
                $damage = $monster->hit($hero);
                $step = $this->getStep($monster, $damage, $hero);
            }

            $regenerateEnergy = rand(0, 20);

            $hero->setEnergy($hero->getEnergy() + $regenerateEnergy);

            $history[] = [
                'heroHit' => $heroHit,
                'status' => $step['status'],
                'state' => $step['state']
            ];

            $heroHit = !$heroHit;

            $this->createHistory($hero, $monster, $history, $heroHit);
        }

        return $history;
    }

    function getWinner(Hero $hero, Monster $monster)
    {
        if ($hero->getHp() > 0) return $hero;

        return $monster;
    }

    function getResult($winner):array
    {
        if (get_parent_class($winner) == 'Hero') {
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

<?php

class Warrior extends Hero {

    public function specialHit(Monster $monster):int
    {
        $damage = rand(0, 20);

        $monster->setHp($monster->getHp() - $damage);
        $this->setEnergy($this->getEnergy() - 50);

        return $damage;
    }

}

?>

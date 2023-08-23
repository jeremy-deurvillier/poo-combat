<?php

class Monster {

    private string $name;
    private int $hp;

    function __construct(array $datas)
    {
        $this->hydrate($datas);
    }
     
     /**
      * Get name.
      *
      * @return name.
      */
     public function getName():string
     {
         return $this->name;
     }
     
     /**
      * Set name.
      *
      * @param name the value to set.
      */
     public function setName($name)
     {
         $this->name = $name;
     }
    
    /**
     * Get hp.
     *
     * @return hp.
     */
    public function getHp():int
    {
        return $this->hp;
    }
    
    /**
     * Set hp.
     *
     * @param hp the value to set.
     */
    public function setHp($hp)
    {
        $this->hp = $hp;
    }

    public function hydrate(array $datas)
    {
        if (isset($datas['name'])) $this->setName($datas['name']);
        if (isset($datas['hp'])) $this->setHp($datas['hp']);
    }

    public function hit(Hero $hero):int
    {
        $damage = rand(0, 20);

        $hero->setHp($hero->getHp() - $damage);

        return $damage;
    }

}

?>

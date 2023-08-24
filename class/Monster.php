<?php

class Monster {

    private string $name;
    private int $hp;
    private string $class;

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
        $this->hp = ($hp >= 0)?$hp:0;
    }

     /**
      * Get class.
      *
      * @return class.
      */
     public function getClass()
     {
         return $this->class;
     }
     
     /**
      * Set class.
      *
      * @param class the value to set.
      */
     public function setClass($class)
     {
         $this->class = $class;
     }

    public function hydrate(array $datas)
    {
        if (isset($datas['name'])) $this->setName($datas['name']);
        if (isset($datas['hp'])) $this->setHp($datas['hp']);
        if (isset($datas['class'])) $this->setClass($datas['class']);
    }

    public function hit(Hero $hero):int
    {
        $damage = rand(0, 20);

        $hero->setHp($hero->getHp() - $damage);

        return $damage;
    }

}

?>

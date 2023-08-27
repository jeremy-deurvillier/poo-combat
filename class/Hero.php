<?php

class Hero {

    private int $id;
    private string $name;
    private int $hp;
    private int $energy;
    private string $class;
    private $invoked;

    const COST_HIT = 15;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }
    
    /**
     * Get id.
     *
     * @return id.
     */
    public function getId():int
    {
        return $this->id;
    }
    
    /**
     * Set id.
     *
     * @param id the value to set.
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Get energy.
     *
     * @return energy.
     */
    public function getEnergy():int
    {
        return $this->energy;
    }
    
    /**
     * Set energy.
     *
     * @param energy the value to set.
     */
    public function setEnergy($energy)
    {
        if ($energy < 100) {
            $this->energy = ($energy >= 0)?$energy:0;
        } else {
            $this->energy = 100;
        }
    }

     /**
      * Get class.
      *
      * @return class.
      */
     public function getClass():string
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

    /**
     * Get invoked.
     *
     * @return invoked.
     */
    public function getInvoked()
    {
        return $this->invoked;
    }
    
    /**
     * Set invoked.
     *
     * @param invoked the value to set.
     */
    public function setInvoked($invoked)
    {
        $this->invoked = $invoked;
    }
 

    private function hydrate(array $datas)
    {
        if (isset($datas['id_hero'])) $this->setId($datas['id_hero']);
        if (isset($datas['name'])) $this->setName($datas['name']);
        if (isset($datas['hp'])) $this->setHp($datas['hp']);
        if (isset($datas['energy'])) $this->setEnergy($datas['energy']);
        if (isset($datas['class'])) $this->setClass($datas['class']);
        if (isset($datas['last_summon'])) $this->setInvoked($datas['last_summon']);
    }

    public function hit(Monster $monster):int
    {
        $damage = rand(0, 20);

        $monster->setHp($monster->getHp() - $damage);
        $this->setEnergy($this->getEnergy() - Hero::COST_HIT);

        return $damage;
    }

    public function run():bool
    {
        return true;
    }

}

?>

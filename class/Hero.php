<?php

class Hero {

    private int $id;
    private string $name;
    private int $hp;

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

    private function hydrate(array $datas)
    {
        if (isset($datas['id_hero'])) $this->setId($datas['id_hero']);
        if (isset($datas['name'])) $this->setName($datas['name']);
        if (isset($datas['hp'])) $this->setHp($datas['hp']);
    }

    public function hit(Monster $monster):int
    {
        $damage = rand(0, 20);

        $monster->setHp($monster->getHp() - $damage);

        return $damage;
    }

}

?>

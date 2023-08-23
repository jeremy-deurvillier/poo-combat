<?php

abstract class Character {

  protected int $id;
  protected string $name;
  protected int $hp;

  public function __construct(array $datas)
  {
    $this->hydrate($datas);
  }

  public function getId():int
  {
    return $this->id;
  }

  public function setId(int $id)
  {
    $this->id = $id;
  }

  public function getName():string
  {
    return $this->name;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function getHp():int
  {
    return $this->hp;
  }

  public function setHp(int $hp)
  {
    $this->hp = $hp;
  }

  public function hydrate(array $datas)
  {
    if (isset($datas['id_hero'])) $this->setId($datas['id_hero']);
    if (isset($datas['name'])) $this->setName($datas['name']);
    if (isset($datas['hp'])) $this->setHp($datas['hp']);
  }


  public function hit(Character $character)
  {
    $damage = rand(0, 20);

    $character->setHp($character->getHp() - $damage);

    return $damage;
  }

}

class Hero extends Character {

  public function specialHit(Character $character) {
    $damage = rand(0, 20);

    $character->setHp($character->getHp() - $damage);

    return $damage;
  }
}

class Monster extends Character {}

$datasHero = ['id_character' => 1, 'name' => 'Jejerem', 'hp' => 100];
$datasMonster = ['id_character' => 2, 'name' => 'Tank', 'hp' => 100];

$h = new Hero($datasHero);
$m = new Monster($datasMonster);

$m->hit($h);
$h->hit($m);
$m->hit($h);
$h->hit($m);
$m->hit($h);
$h->hit($m);

echo $h->getHp() . PHP_EOL;
echo $m->getHp() . PHP_EOL;

?>

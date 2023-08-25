<?php

class HeroesManager {

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    /**
     * Get db.
     *
     * @return db.
     */
    public function getDb():PDO
    {
        return $this->db;
    }
    
    /**
     * Set db.
     *
     * @param db the value to set.
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    public function add(Hero $hero):bool
    {
        try {
            $sql = 'INSERT INTO heroes(name, class) VALUES (:name, :class);';

            $request = $this->getDb()->prepare($sql);

            $isCreated = $request->execute([
                ':name' => $hero->getName(),
                ':class' => $hero->getClass()
            ]);

            if ($isCreated) {
                $id = $this->getDb()->lastInsertId();

                $hero->setId($id);
                $hero->setHp(100);
            }

            return $isCreated;

        } catch (PDOException $error) {
            print_r($error);

            return false;
        }
    }

    public function findAll():array
    {
        try {
            $heroesList = [];
            $sql = 'SELECT * FROM heroes LIMIT 12 OFFSET 0;';

            $request = $this->getDb()->query($sql);
            $heroes = $request->fetchAll(PDO::FETCH_ASSOC);

            foreach ($heroes as $data) {
                $heroesList[] = new Hero($data);
            }

            return $heroesList;

        } catch (PDOException $error) {
            print_r($error);

            return [];
        }
    }

    public function findAllAlive():array
    {
        try {
            $heroesList = [];
            $sql = 'SELECT * FROM heroes WHERE hp > 0;';

            $request = $this->getDb()->query($sql);
            $heroesAlive = $request->fetchAll(PDO::FETCH_ASSOC);

            foreach ($heroesAlive as $data) {
                $heroesList[] = new Hero($data);
            }

            return $heroesList;

        } catch (PDOException $error) {
            print_r($error);

            return [];
        }
    }

    public function find(int $id):Hero|bool
    {
        try {
            $sql = 'SELECT * FROM heroes WHERE id_hero = :id;';

            $request = $this->getDb()->prepare($sql);

            $request->execute([':id' => $id]);

            $hero = $request->fetch(PDO::FETCH_ASSOC);

            if ($hero) {
                $class = ucfirst($hero['class']);

                return new $class($hero);
            }

            return false;

        } catch (PDOException $error) {
            print_r($error);

            return false;
        }
    }

    public function update(Hero $hero):bool
    {
        try {
            $sql = 'UPDATE heroes SET hp = :hp, energy = :eng WHERE id_hero = :id;';

            $request = $this->getDb()->prepare($sql);

            return $request->execute([
                ':hp' => $hero->getHp(),
                ':eng' => $hero->getEnergy(),
                ':id' => $hero->getId()
            ]);

        } catch (PDOException $error) {
            print_r($error);

            return false;
        }
    }

    public function invoke(int $hero):bool
    {
        try {
            $sql = 'UPDATE heroes SET last_summon = DATE_ADD(NOW(), INTERVAL 3 MINUTE) WHERE id_hero = :id;';

            $request = $this->getDb()->prepare($sql);

            return $request->execute([
                ':id' => $hero,
            ]);

        } catch (PDOException $error) {
            print_r($error);

            return false;
        }
 
    }

    public function conditioning(int $hero):bool
    {
        try {
            $sql = 'UPDATE heroes SET hp = 120, energy = 100, last_summon = null WHERE id_hero = :id;';

            $request = $this->getDb()->prepare($sql);

            return $request->execute([
                ':id' => $hero,
            ]);

        } catch (PDOException $error) {
            print_r($error);

            return false;
        }
 
    }

}

?>

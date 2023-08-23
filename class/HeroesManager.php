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
            $sql = 'INSERT INTO heroes(name) VALUES (:name);';

            $request = $this->getDb()->prepare($sql);

            $isCreated = $request->execute([':name' => $hero->getName()]);

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

    public function findAllAlive():array
    {
        try {
            $heroesList = [];
            $sql = 'SELECT id_hero, name, hp FROM heroes WHERE hp > 0;';

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

    public function find(int $id):Hero
    {
        try {
            $sql = 'SELECT id_hero, name, hp FROM heroes WHERE id_hero = :id;';

            $request = $this->getDb()->prepare($sql);

            $request->execute([':id' => $id]);

            $hero = $request->fetch(PDO::FETCH_ASSOC);

            if ($hero) {
                return new Hero($hero);
            }

            return false;

        } catch (PDOException $error) {
            print_r($error);

            return false;
        }
    }

    public function update(int $id):bool
    {/*
        try {
            $sql = 'SELECT id_hero, name, hp FROM heroes WHERE id_hero = :id;';

            $request = $this->getDb()->prepare($sql);

            $request->execute([':id' => $id]);

            $hero = $request->fetch(PDO::FETCH_ASSOC);

            if ($hero) {
                return new Hero($hero);
            }

            return false;

        } catch (PDOException $error) {
            print_r($error);

            return false;
        }
     */}

}

?>
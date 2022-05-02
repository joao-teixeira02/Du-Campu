<?php
    declare(strict_types = 1);

    class Dish{
        public int $id;
        public string $name;
        public float $price;
        
        public function __construct(int $id, string $name, float $price){ 
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        }

        static function getPhoto(PDO $db, int $id) : ?string {
            $stmt = $db->prepare('SELECT path FROM Photo WHERE Photo.id=(SELECT id_photo FROM Dish WHERE Dish.id=?');
            $stmt->execute(array($id));
            return $stmt->fetch();
        }
    }



?>
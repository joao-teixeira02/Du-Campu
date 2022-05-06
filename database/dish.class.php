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

        function getName() : string {
            return $this->name;
        }

        function getPrice() : float {
            return $this->price;
        }

        static function getPhoto(PDO $db, int $id) : ?string {
            $stmt = $db->prepare('SELECT path FROM Photo WHERE Photo.id=(SELECT id_photo FROM Dish WHERE Dish.id=?)');
            $stmt->execute(array($id));
            return $stmt->fetch()['path'];
        }

        function getType(PDO $db) : ?string {
            
            $stmt = $db->prepare('SELECT name FROM Type WHERE Type.id=(SELECT id_type FROM DishType WHERE DishType.id_dish=?)');
            $stmt->execute(array($this->id));

            $type = null;
            while ($type_data = $stmt->fetch()) {
                $type = $type_data["name"];
                
                break;
            }
            return $type;
        }


    }



?>
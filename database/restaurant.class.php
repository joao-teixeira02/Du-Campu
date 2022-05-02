<?php
    declare(strict_types = 1);

    class Restaurant{
        public int $id;
        public string $name;
        public string $address;
        public int $owner_id;

        static function getDishes(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM Dish WHERE Dish.restaurant_id=?');
            $stmt->execute(array($id));
            $dishes = array();
            while ($dish = $stmt->fetch()) {
                $dishes[] = new Dish(
                  $dish['id'],
                  $dish['name'],
                  $dish['price']
                );
              }
            return $dishes;
        }

        static function getPhoto(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT path FROM Photo WHERE Photo.id=(SELECT id_photo FROM RestaurantPhoto WHERE Restaurant.id=?');
            $stmt->execute(array($id));
            $paths = array();
            while ($path = $stmt->fetch()) {
                $paths[] = $path;
            }
            return $paths;
        }

        static function calcRating(PDO $db, int $id) : int {
            $stmt = $db->prepare('SELECT points FROM Reviews WHERE Reviews.restaurant_id=?');
            $stmt->execute(array($id));
            $a = $stmt->fetchAll();
            return array_sum($a)/count($a);
        }

        static function getCategory(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT name FROM Category WHERE Category.id=(SELECT id_restaurant FROM RestaurantCategory WHERE Restaurant.id=?');
            $stmt->execute(array($id));
            $categories = array();
            while ($category = $stmt->fetch()) {
                $categories[] = $category;
            }
            return $categories;
        }
        
        public function __construct(int $id, string $name, string $address, int $owner_id){ 
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->owner_id = $owner_id;
        }

        

    }



?>
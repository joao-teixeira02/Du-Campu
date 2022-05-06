<?php
    declare(strict_types = 1);
    
    require_once('database/dish.class.php');

    class Restaurant{
        public int $id;
        public string $name;
        public string $address;
        public int $owner_id;

        static function getRestaurant(PDO $db, int $id) : ?Restaurant {
            $stmt = $db->prepare('SELECT * FROM Restaurant WHERE Restaurant.id=?');
            $stmt->execute(array($id));
        
            $restaurant = null;
            while ($restaurant_data = $stmt->fetch()) {
                $restaurant = new Restaurant(
                intval($restaurant_data['id']),
                $restaurant_data['name'],
                $restaurant_data['address'],
                intval($restaurant_data['owner_id'])
                );
                
                break;
            }
    
            return $restaurant;
        }

        function getName() : string {
            return $this->name;
        }

        static function getDishes(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM Dish WHERE Dish.restaurant_id=?');
            $stmt->execute(array($id));
            $dishes = array();
            while ($dish = $stmt->fetch()) {
                
                $dishes[] = new Dish(
                    intval($dish['id']),
                    $dish['name'],
                    floatval($dish['price'])
                );
                
            }
            return $dishes;
        }

        static function getPhoto(PDO $db, int $id) : string {
            $stmt = $db->prepare('SELECT path FROM Photo WHERE Photo.id=(SELECT id_photo FROM RestaurantPhoto WHERE RestaurantPhoto.id_restaurant=?)');
            $stmt->execute(array($id));
            $path = $stmt->fetch();
            return $path['path'];
        }

        static function calcRating(PDO $db, int $id) : int {
            $stmt = $db->prepare('SELECT points FROM Reviews WHERE Reviews.restaurant_id=?');
            $stmt->execute(array($id));
            $a = array();
            while ($rating = $stmt->fetch()) {
                $a[] = $rating['points'];
            }
            return array_sum($a)/count($a);
        }

        static function getCategory(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM Category WHERE Category.id IN (SELECT id_category FROM RestaurantCategory WHERE RestaurantCategory.id_restaurant=?)');
            $stmt->execute(array($id));
            $categories = array();
            while ($category = $stmt->fetch()) {
                $categories[] = $category['name'];
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
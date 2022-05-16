<?php
    declare(strict_types = 1);
    ini_set("precision", "2");
    
    require_once('database/dish.class.php');
    require_once('database/connection.db.php');

    class Restaurant{
        public int $id;
        public string $name;
        public string $address;
        public array $categories;
        public float $rating;
        public string $price;
        public ?string $photo;
        public int $owner_id;

        public function __construct(int $id, string $name, string $address, int $owner_id){ 
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->owner_id = $owner_id;
            
            $db = getDatabaseConnection();

            $this->categories = Restaurant::getCategory($db, $id);
            $this->rating = Restaurant::calcRating($db, $id);
            $this->photo = Restaurant::getPhoto($db, $id);
        }

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

        static function getPhoto(PDO $db, int $id) : ?string {
            $stmt = $db->prepare('SELECT path FROM Photo WHERE Photo.id=(SELECT id_photo FROM RestaurantPhoto WHERE RestaurantPhoto.id_restaurant=?)');
            $stmt->execute(array($id));
            $path = $stmt->fetch();
            return $path['path'];
        }

        static function calcRating(PDO $db, int $id) : float {
            $stmt = $db->prepare('SELECT points FROM Reviews WHERE Reviews.restaurant_id=?');
            $stmt->execute(array($id));
            $a = array();
            while ($rating = $stmt->fetch()) {
                $a[] = $rating['points'];
            }
            if(count($a)===0) return 0.0;
            return (float)((array_sum($a))/count($a));
        }

        static function getCategory(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT name FROM Category JOIN RestaurantCategory  WHERE Category.id = RestaurantCategory.id_category and RestaurantCategory.id_restaurant=?');
            $stmt->execute(array($id));
            $categories = array();
            while ($category = $stmt->fetch()) {
                $categories[] = $category['name'];
            }
            return $categories;
        }


        static function search(PDO $db, string $name, array $category, array $prices, float $rating_min, float $rating_max, string $orderBy ) : array {
            /*string $que = 'SELECT * FROM Restaurant WHERE name like \"%:name%\" AND  :rating_min <= (SELECT avg(points) FROM Reviews) <= :rating_max';*/

            
            $stmt = $db->prepare('SELECT * FROM Restaurant WHERE name like "%%" AND  0 <= (SELECT avg(points) FROM Reviews) <= 5');

            /*
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":rating_min", $rating_min);
            $stmt->bindParam(":rating_max", $rating_max);
            /*$stmt->bindParam(":category", $category);*/
            

            $stmt->execute();
            $restaurants = array();
            while ($restaurant_data = $stmt->fetch()) {
                $restaurants[] = new Restaurant(intval($restaurant_data['id']),
                                                $restaurant_data['name'],
                                                $restaurant_data['address'],
                                                intval($restaurant_data['owner_id']));
            }
            return $restaurants;
        }
        

    }



?>
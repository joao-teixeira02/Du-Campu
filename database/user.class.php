<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/restaurant.class.php');

    class User{
        public int $id;
        public string $username;
        public string $password;
        public int $photo;
        
        public function __construct(int $id, string $username, string $password, int $photo){ 
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->photo = $photo;
        }

        static function getUser(PDO $db, string $username) : ?User {
            $stmt = $db->prepare('SELECT * FROM User WHERE User.username=?');
            $stmt->execute(array($username));
        
            $user = null;
            while ($user_data = $stmt->fetch()) {
                $user = new User(
                intval($user_data['id']),
                $user_data['username'],
                $user_data['password'],
                intval($user_data['photo'])
                );
                
                break;
            }
    
            return $user;
        }

        static function getFavRestaurants(PDO $db, int $id) : array {

            $stmt = $db->prepare(
                'SELECT Restaurant.id, Restaurant.name, Restaurant.address, Restaurant.owner_id, Restaurant.price FROM Restaurant JOIN FavoriteRestaurant
             ON Restaurant.id=FavoriteRestaurant.id_restaurant AND FavoriteRestaurant.id_user=?');
             $stmt->execute(array($id));
            $restaurants = array();
            while($restaurant_data = $stmt->fetch()) {
                $restaurants[] = new Restaurant(
                    intval($restaurant_data['id']),
                    $restaurant_data['name'],
                    $restaurant_data['address'],
                    intval($restaurant_data['owner_id']),
                    intval($restaurant_data['owner_id']),
                    intval($restaurant_data['price'])
                );
            }
            return $restaurants;
        }

        static function getFavDishes(PDO $db, int $id) : array {
            $stmt = $db->prepare(
                'SELECT Dish.id, Dish.name, Dish.price, Dish.restaurant_id FROM Dish JOIN FavoriteDish
             ON Dish.id=FavoriteDish.id_dish AND FavoriteDish.id_user=?');
            $stmt->execute(array($id));

            $dishes = array();
            while($dish_data = $stmt->fetch()) {
                $dishes[] = new Dish(
                    intval($dish_data['id']),
                    $dish_data['name'],
                    floatval($dish_data['price']),
                    intval($dish_data['restaurant_id'])
                );
            }
            return $dishes;
        }


        static function isCustomer(PDO $db, string $username) : bool {

            $stmt = $db->prepare('SELECT Owner.id as id FROM Owner INNER JOIN User ON (Owner.id=User.id AND User.username=?)');

            $stmt->execute(array($username));

            $id = $stmt->fetch()['id'];

            return $id === null;

        }

        function getPhoto(PDO $db) : string {

            $stmt = $db->prepare('SELECT path FROM Photo where id=?');
            $stmt->execute(array($this->photo));

            $path = $stmt->fetch()['path'];

            return $path;

        }
    }



?>
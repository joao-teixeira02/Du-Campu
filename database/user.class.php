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
            $stmt = $db->prepare('SELECT id_restaurant FROM FavoriteRestaurant WHERE FavoriteRestaurant.id_user=?');
            $stmt->execute(array($id));

            $idRestaurants = $stmt->fetchAll();

            $stmt = $db->prepare('SELECT * FROM Restaurant WHERE Restaurant.id=?');
            $restaurants = array();
            foreach($idRestaurants as $idRestaurant) {
                $stmt->execute(array(intval($idRestaurant)));
                while($restaurant_data = $stmt->fetch()) {
                    $restaurants[] = new Restaurant(
                        intval($restaurant_data['id']),
                        $restaurant_data['name'],
                        $restaurant_data['address'],
                        intval($restaurant_data['owner_id'])
                    );
                }
            }
            return $restaurants;
        }

        static function getFavDishes(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT id_dish FROM FavoriteDish WHERE FavoriteDish.id_user=?');
            $stmt->execute(array($id));

            $idDishes = $stmt->fetchAll();

            $stmt = $db->prepare('SELECT * FROM Dish WHERE Dish.id=?');
            $dishes = array();
            foreach($idDishes as $idDish) {
                $stmt->execute(array(intval($idDish)));
                while($dish_data = $stmt->fetch()) {
                    $dishes[] = new Dish(
                        intval($dish_data['id']),
                        $dish_data['name'],
                        floatval($dish_data['price']),
                        intval($dish_data['restaurant_id'])
                    );
                }
            }
            return $dishes;
        }


        static function isCustomer(PDO $db, string $username) : bool {

            $stmt = $db->prepare('SELECT Owner.id FROM Owner INNER JOIN User ON (Owner.id=User.id AND User.username=?)');
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
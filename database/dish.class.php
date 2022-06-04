<?php
    declare(strict_types = 1);

    class Dish{
        public int $id;
        public string $name;
        public float $price;
        public int $restaurant_id;
        
        public function __construct(int $id, string $name, float $price, int $restaurant_id){ 
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->restaurant_id = $restaurant_id;
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
                $type = $type_data['name'];
                
                break;
            }
            return $type;
        }

        static function getDish(PDO $db, int $dish_id) : ?Dish {
            
            $stmt = $db->prepare('SELECT * FROM Dish WHERE id=:dish_id');
            $stmt->bindParam(':dish_id', $dish_id);
            $stmt->execute();

            $dish_data = $stmt->fetch();
            if($dish_data){
                $dish = new Dish(intval($dish_data['id']), 
                        $dish_data['name'],
                        floatval($dish_data['price']), 
                        intval($dish_data['restaurant_id']));
                return $dish;
            }else{
                return null;
            }
        }

        function isFavDish(PDO $db, int $user_id) : bool {
            $stmt = $db->prepare('SELECT * FROM FavoriteDish WHERE FavoriteDish.id_user=? AND FavoriteDish.id_dish=?');
            $stmt->execute(array($user_id, $this->id));

            if($stmt->fetch()){
                return true;
            }
            return false;
        }


    }



?>
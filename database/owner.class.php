<?php
    declare(strict_types = 1);

    class Owner{
        public int $id;
        public string $username;
        public string $password;
        
        public function __construct(int $id, string $username, string $password){ 
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        }

        static function getOwner(PDO $db, string $username) : ?Owner {
            $stmt = $db->prepare('SELECT * FROM Owner WHERE Owner.username=?');
            $stmt->execute(array($username));
        
            $owner = null;
            while ($owner_data = $stmt->fetch()) {
                $owner = new Owner(
                intval($owner_data['id']),
                $owner_data['username'],
                $owner_data['password']
                );
                
                break;
            }
    
            return $owner;
        }

        static function getRestaurants(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM Restaurant WHERE Restaurant.owner_id=?');
            $stmt->execute(array($id));

            $restaurants = array();
            while ($restaurant = $stmt->fetch()) {
                
                $restaurants[] = new Restaurant(
                    intval($restaurant['id']),
                    $restaurant['name'],
                    $restaurant['address'],
                    intval($restaurant['owner_id']),
                    intval($restaurant['price'])
                );
                
            }
            return $restaurants;
        }

    }



?>
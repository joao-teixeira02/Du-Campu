<?php
    declare(strict_types = 1);

    class Owner{
        
        
        static function getRestaurants(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM Restaurant WHERE Restaurant.owner_id=?');
            $stmt->execute(array($id));

            $restaurants = array();
            while ($restaurant_data = $stmt->fetch()) {
                
                $restaurants[] = new Restaurant(
                    intval($restaurant_data['id']),
                    $restaurant_data['name'],
                    $restaurant_data['address'],
                    intval($restaurant_data['owner_id']),
                    intval($restaurant_data['price'])
                );
                
            }
            return $restaurants;
        }

    }



?>
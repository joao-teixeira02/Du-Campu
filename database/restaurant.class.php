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


        static function search(PDO $db, string $name, array $categories, array $prices, float $rating_min, float $rating_max, string $orderBy, bool $asc ) : array {
            $query = "";

            $name = trim($name);
            if(!empty($name)){ 
                // select a restaurant with a name like $nama, or that has a food with that name

                $name = "%".$name."%";
                $query .= ' SELECT id FROM Restaurant WHERE name like :name 
                            UNION SELECT restaurant_id as id FROM Dish WHERE name like :name  INTERSECT ';

            }
            
            $nCategories = count($categories)-1;

            if($nCategories > 0){
                // select restaurants with categories in categories
                $query .= ' Select id FROM Restaurant join RestaurantCategory on (RestaurantCategory.id_restaurant = Restaurant.id) WHERE ';
                
                for($i = 0; $i<$nCategories; $i++){
                    if($i != 0){
                        $query .= ' OR ';
                    }
                    $query .= ' RestaurantCategory.id_category = :category'.$i;
                }
                
                $query .= ' INTERSECT ';
            }


            // select a restaurant with the avg reviews score between rating_min and rating_max
            $query .= ' SELECT id FROM Restaurant WHERE ( ( (SELECT avg(points) FROM Reviews Where Reviews.restaurant_id = Restaurant.id) 
            BETWEEN CAST(:rating_min AS FLOAT) AND CAST(:rating_max AS FLOAT) ) ';
            
            // also select  if it doesn't have any reviews and rating_min equal to 0 
            $query .= ' OR ( (SELECT count(points) FROM Reviews Where Reviews.restaurant_id = Restaurant.id) = 0 AND 0 = CAST(:rating_min AS FLOAT) ) )';

            
            // select all columns of restaurant and de avg points of reviews (rating)
            $query = "SELECT *, (SELECT avg(points) FROM Reviews Where Reviews.restaurant_id = Restaurant.id) as rating FROM Restaurant WHERE id in (".$query.")";
          
            if($orderBy === "rating"){
                $query .= " order by rating " . ($asc?'asc':'desc');
            }

            $stmt = $db->prepare($query);            

            if(!empty($name)){
                
                $name = '%'.$name.'%';
                $stmt->bindParam(':name', $name);
            }
            $stmt->bindParam(":rating_min", $rating_min);
            $stmt->bindParam(":rating_max", $rating_max);


            for($i = 0; $i<$nCategories; $i++){
                $stmt->bindParam(":category".$i, $categories[$i]);
            }


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
<?php
    require_once(__DIR__ . "/../database/connection.db.php");
    require_once(__DIR__ . "/../database/dish.class.php");

    class Cart{
        public array $orders;
        
        public function __construct(){ 
            $this->orders = array();
        }

        public function setDishQuantity(int $idDish, int $quantity){
            
            $db = getDatabaseConnection();
            $dish = Dish::getDish($db, $idDish);
            
            if ($quantity===0 ){
                $this->removeDish($idDish);
                return;
            }                

            $this->orders[$dish->restaurant_id][$idDish] = $quantity;
        }

        public function removeDish(int $idDish){
            $db = getDatabaseConnection();
            $dish = Dish::getDish($db, $idDish);

            if (isset($this->orders[$dish->restaurant_id][$idDish])){
                unset($this->orders[$dish->restaurant_id][$idDish]);  
            }

            if (empty($this->orders[$dish->restaurant_id])){
                unset($this->orders[$dish->restaurant_id]);  
            }
        }


    }


?>
<?php

    class Cart{
        public array $orders;
        
        public function __construct(){ 
            $this->orders = array();
        }

        public function setDishQuantity(int $idDish, int $quantity){
            if ($quantity===0 && isset($this->orders[$idDish])){
                unset($this->orders[$idDish]);  
            }else{
                $this->orders[$idDish] = $quantity;
            }
        }

        public function removeDish(int $idDish){
            if (isset($this->orders[$idDish])){
                unset($this->orders[$idDish]);  
            }
        }


    }


?>
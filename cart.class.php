<?php

    class Cart{
        private array $orders;
        
        public function __construct(){ 
            $this->orders = array();
        }

        public function setDishQuantity(int $idDish, int $quantity){
            $this->orders[$idDish] = $quantity;
        }


    }


?>
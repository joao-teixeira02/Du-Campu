<?php
    declare(strict_types = 1);
    
    class Order{
        public int $id;
        public int $state_id;
        public int $customer_id;

        
        public function __construct(int $id, int $state_id, int $customer_id){ 
            $this->id = $id;
            $this->state_id = $state_id;
            $this->customer_id = $customer_id;
        }

        public static function getFromDatabase(PDO $db, int $order_id) : ?Order{
            $stmt = $db->prepare('SELECT * FROM "Order" WHERE id=:order_id');
            $stmt->bindParam(':order_id', $order_id);
            $stmt->execute();

            $order_data = $stmt->fetch();
            if($order_data){
                $order = new Order(intval($order_data['id']), 
                        intval($order_data['state_id']),
                        intval($order_data['customer_id']));
                return $order;
            }else{
                return null;
            }
        }

        public function insertIntoDatabase(PDO $db){
            $stmt = $db->prepare('INSERT INTO "Order" (state_id, customer_id) VALUES (?, ?)');
            $stmt->execute(array($this->state_id, $this->customer_id));
        }

        public function addDishInDatabase(PDO $db, int $id_dish, int $quantity){
            $stmt = $db->prepare('INSERT INTO "OrderDishQuantity" (id_order, id_dish, quantity) VALUES (?, ?, ?)');
            $stmt->execute(array($this->id, $id_dish, $quantity));
        }

    }

?>
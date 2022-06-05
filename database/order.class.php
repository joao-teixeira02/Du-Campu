<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/restaurant.class.php');
    
    class Order{
        public int $id;
        public int $state_id;
        public int $customer_id;
        public string $date;

        
        public function __construct(int $id, int $state_id, int $customer_id, string $date){ 
            $this->id = $id;
            $this->state_id = $state_id;
            $this->customer_id = $customer_id;
            $this->date = $date;
        }

        public static function getFromDatabase(PDO $db, int $order_id) : ?Order{
            $stmt = $db->prepare('SELECT * FROM "Order" WHERE id=:order_id');
            $stmt->bindParam(':order_id', $order_id);
            $stmt->execute();

            $order_data = $stmt->fetch();
            if($order_data){
                $order = new Order(intval($order_data['id']), 
                        intval($order_data['state_id']),
                        intval($order_data['customer_id']),
                        $order_data['date']);
                return $order;
            }else{
                return null;
            }
        
        }

        public static function getOrderWithState(PDO $db, int $state_id, int $customer_id) : ?array{
            $stmt = $db->prepare('SELECT * FROM "Order" WHERE state_id=:state_id AND customer_id=:customer_id order by date ');
            $stmt->bindParam(':state_id', $state_id);
            $stmt->bindParam(':customer_id', $customer_id);
            $stmt->execute();


            $orders = array();
            while ($order_data = $stmt->fetch()) {
                $orders[] = new Order(intval($order_data['id']), 
                                    intval($order_data['state_id']),
                                    intval($order_data['customer_id']),
                                    $order_data['date']);
            }
            
            return $orders;
        
        }

        public static function getOrderActive(PDO $db, int $customer_id) : ?array{
            $stmt = $db->prepare('SELECT * FROM "Order" WHERE state_id<>4 AND customer_id=:customer_id order by date DESC');
            $stmt->bindParam(':customer_id', $customer_id);
            $stmt->execute();


            $orders = array();
            while ($order_data = $stmt->fetch()) {
                
                $order = new Order(intval($order_data['id']), 
                                    intval($order_data['state_id']),
                                    intval($order_data['customer_id']),
                                    $order_data['date']
                                );
                if(count($order->getDishesAndQuantities($db)) > 0){
                    $orders[]=$order;
                }
            }
            return $orders;
        
        }

        public function getDishesAndQuantities(PDO $db) : ?array{
            $stmt = $db->prepare('SELECT * FROM "OrderDishQuantity" WHERE id_order=:id_order');
            $stmt->bindParam(':id_order', $this->id);
            $stmt->execute();


            $orders_dishes = array();
            while ($order_data = $stmt->fetch()) {
                $dish_quantity = array();
                $dish_quantity[0] = Dish::getDish($db, intval($order_data["id_dish"]));
                $dish_quantity[1] = intval($order_data["quantity"]);
                $orders_dishes[] = $dish_quantity;
            }
            return $orders_dishes;  
        }

        public function getRestaurant(PDO $db) : ?Restaurant{
            $stmt = $db->prepare('SELECT * FROM "OrderDishQuantity" WHERE id_order=:id_order');
            $stmt->bindParam(':id_order', $this->id);
            $stmt->execute();


            $restaurante = null;
            if ($order_data = $stmt->fetch()) {
                $restaurante_id = Dish::getDish($db, intval($order_data["id_dish"]))->restaurant_id;
                $restaurante = Restaurant::getRestaurant($db, $restaurante_id);
                return $restaurante;
            }
            return $restaurante;  
        }

        public function getTotalPrice(PDO $db) : float {
            $total = 0;
            foreach($this->getDishesAndQuantities($db) as $dish_quantity) {
                $total += $dish_quantity[0]->price*$dish_quantity[1];
            }

            return $total;
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
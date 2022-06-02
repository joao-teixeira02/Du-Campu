<?php   
    declare(strict_types = 1);
        
    require_once(__DIR__ . "/../database/cart.class.php");
    require_once(__DIR__ . "/../utils/session.php");
    require_once(__DIR__ . "/../database/connection.db.php");
    require_once(__DIR__ . "/../database/order.class.php");
    require_once(__DIR__ . "/../database/user.class.php");
    $session = new Session();

    if($session->isLogged()){

        $db = getDatabaseConnection();

        $this_user = User::getUser($db, $session->getUsername());

        
        $session->loadCart();


        foreach( $session->cart->orders as $id_restaurant => $dishes ){
            $order = new Order(0, 1, $this_user->id);
            $order->insertIntoDatabase($db);
            $id = $db->lastInsertId();
            $order = Order::getFromDatabase($db, intval($id));
    
            foreach( $dishes as $id_dish => $quantity ){
                if($order_id){
                    $order->addDishInDatabase($db, $id_dish, $quantity);
                }
            }
        }

        unset($_SESSION["cart"]);
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        
        header('Location: ' .  '/login.php');
    }

?>
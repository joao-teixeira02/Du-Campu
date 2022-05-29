<?php   
    declare(strict_types = 1);
        
    require_once(__DIR__ . "/../cart.class.php");
    require_once(__DIR__ . "/../utils/session.php");
    require_once(__DIR__ . "/../database/connection.db.php");
    require_once(__DIR__ . "/../database/order.class.php");
    require_once(__DIR__ . "/../database/user.class.php");
    $session = new Session();

    if($session->isLogged()){

        $db = getDatabaseConnection();

        $this_user = User::getUser($db, $session->getUsername());

        $order = new Order(0, 1, $this_user->id);
        $order->insertIntoDatabase($db);
        $id = $db->lastInsertId();
        $order = Order::getFromDatabase($db, intval($id));

        $session->loadCart();

        foreach( $session->cart->orders as $id_dish => $quantity ){
            $order->addDishInDatabase($db, $id_dish, $quantity);
        }

        unset($_SESSION["cart"]);
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        
        header('Location: ' .  '/login.php');
    }

?>
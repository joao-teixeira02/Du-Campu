<?php

    declare(strict_types = 1);
    
    
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    $session = new Session();
    $db = getDatabaseConnection();

    $cart_dishes = array();

    // percorrer as dishes que estao no carrinho
    foreach ($session->cart->orders as $dish_id => $dish_quantity) {
        $dish = Dish::getDish($db, intval($dish_id));
        $restaurant = Restaurant::getRestaurant($db, intval($dish->restaurant_id));
        $orders_list = array();
        if(isset($cart_dishes[$restaurant->id])){
            $orders_list  = $cart_dishes[$restaurant->id]['orders'];
            
        }
        $orders_list[] = ['dish'=>$dish, 'quantity' => $dish_quantity];

        $cart_dishes[$restaurant->id] = ['restaurant'=>$restaurant, 'orders'=>$orders_list];
    }
    

    echo(json_encode($cart_dishes));

    

?>
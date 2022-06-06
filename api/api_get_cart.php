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
    foreach ($session->cart->orders as $restaurant_id => $dishes) {
        $restaurant = Restaurant::getRestaurant($db, $restaurant_id);
        
        $orders_list_this_restaurant = array();
        foreach ($dishes as $dish_id => $dish_quantity){
            $dish = Dish::getDish($db, $dish_id);
            $orders_list_this_restaurant[] = ['dish'=>$dish, 'quantity' => $dish_quantity];
        }

        $cart_dishes[$restaurant->id] = ['restaurant'=>$restaurant, 'orders'=>$orders_list_this_restaurant];
    }
    

    echo(json_encode($cart_dishes));

    

?>
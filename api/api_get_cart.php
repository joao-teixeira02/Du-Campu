<?php

    declare(strict_types = 1);
    
    
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    $session = new Session();
    $db = getDatabaseConnection();

    $cart_dishes = array();

    foreach ($session->cart->orders as $dish_id => $dish_quantity) {
        $dish = Dish::getDish($db, intval($dish_id));
        $restaurant = Restaurant::getRestaurant($db, intval($dish->restaurant_id));

        $cart_dishes[$restaurant->id] = ['restaurant'=>$restaurant,'dish'=>$dish, 'quantity' => $dish_quantity];
    }
    

    echo(json_encode($cart_dishes));

?>
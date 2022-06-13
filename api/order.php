<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/order.class.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/state.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');


    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $db = getDatabaseConnection();
        $order = Order::getFromDatabase($db, intval($_GET['id']));
        if($order != null){
            
            $user = User::getUserById($db, $order->customer_id);

            $order_data = array();
            $order_data['id'] = $order->id;
            $order_data['restaurant'] = $order->getRestaurant($db)->name;
            $order_data['data'] = $order->date;
            $order_data['total_price'] = number_format($order->getTotalPrice($db),2);
            $order_data['state'] = State::getStatebyId( $db, $order->state_id)->name;
            $order_data['dishes'] = $order->getDishesAndQuantities($db);
            $order_data['user_name'] = $user->name;
            $order_data['user_address'] = $user->address;
            

            echo json_encode($order_data);
            exit(0);
        }
    }




?>
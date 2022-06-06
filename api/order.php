<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/order.class.php');
    require_once(__DIR__ . '/../database/state.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');

/**
 * GET /employee/1234 HTTP/1.1
 *   Host: www.example.com
 *   Accept: application/json
 */

    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $db = getDatabaseConnection();
        $order = Order::getFromDatabase($db, intval($_GET['id']) );
        if($order != null){

            $order_data = array();
            $order_data['id'] = $order->id;
            $order_data['restaurant'] = $order->getRestaurant($db)->name;
            $order_data['data'] = $order->date;
            $order_data['total_price'] = number_format($order->getTotalPrice($db),2);
            $order_data['state'] = State::getStatebyId( $db, $order->state_id)->name;
            $order_data['dishes'] = $order->getDishesAndQuantities($db);
            

            echo json_encode($order_data);
            exit(0);
        }
    }




?>
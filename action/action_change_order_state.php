<?php

    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/dish.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/order.class.php');
    require_once(__DIR__ . '/../database/state.class.php');
    require_once(__DIR__ . '/../utils/session.php');

    

    if(isset($_POST['state_id']) && is_numeric($_POST['state_id']) && isset($_POST['order_id']) && is_numeric($_POST['order_id']) ){

        $session = new Session();
        $db = getDatabaseConnection();

        $order = Order::getFromDatabase($db, intval($_POST['order_id']));
        
        $state = State::getStatebyId($db, intval($_POST['state_id']));

        if($state!==null){
            $order->state_id = intval($_POST['state_id']);
            $order->updateInDatabase($db);
        }

    }

    header('Location: '. $_SERVER['HTTP_REFERER']);

?>
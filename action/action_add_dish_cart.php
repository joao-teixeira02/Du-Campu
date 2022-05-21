<?php
    declare(strict_types = 1);
    
    require_once("../cart.class.php");
    require_once("../utils/session.php");


    if(isset($_GET["id_dish"]) && is_numeric($_GET["id_dish"]) && isset($_GET["dish_quantity"]) && is_numeric($_GET["dish_quantity"])){
        
        $session = new Session();

        $session->cart->setDishQuantity(intval($_GET["id_dish"]), intval($_GET["dish_quantity"]));
        $session->saveCart();
        
    }


?>
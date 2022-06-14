<?php
    declare(strict_types = 1);
    
    require_once(__DIR__ . "/../database/cart.class.php");
    require_once(__DIR__ . "/../utils/session.php");

    $session = new Session();

    if(isset($_POST["id_dish"]) && is_numeric($_POST["id_dish"]) && isset($_POST["dish_quantity"]) && is_numeric($_POST["dish_quantity"]) && isset($_POST['csrf'])){

      if ($_SESSION['csrf'] !== $_POST['csrf']) {
        die;
      }

      $session->cart->setDishQuantity(intval($_POST["id_dish"]), intval($_POST["dish_quantity"]));
      $session->saveCart();
      
    }

    
  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
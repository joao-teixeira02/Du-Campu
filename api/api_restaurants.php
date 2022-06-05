<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../utils/session.php');

  $db = getDatabaseConnection();

  if(!isset($_GET['name']) || !isset($_GET['category']) || !isset($_GET['rating_min']) ||
   !isset($_GET['rating_max']) || !isset($_GET['order']) || !isset($_GET['asc']) || !isset($_GET['price'])){
    echo json_encode([]);
  }else{

    $categories_arr = explode(',', $_GET['category']);

    $price_arr_str = explode(',', $_GET['price']);

    $restaurants = Restaurant::search($db, $_GET['name'], $categories_arr, $price_arr_str,
              floatval($_GET['rating_min']), floatval($_GET['rating_max']), $_GET['order'], boolval($_GET['asc']) );

    echo json_encode($restaurants);
  }
?>
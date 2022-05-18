<?php
  declare(strict_types = 1);

  require_once('database/connection.db.php');
  require_once('database/restaurant.class.php');

  $db = getDatabaseConnection();

  if(!isset($_GET['name']) || !isset($_GET['category']) || !isset($_GET['rating_min']) ||
   !isset($_GET['rating_max']) || !isset($_GET['order']) || !isset($_GET['asc']) ){
    echo json_encode([]);
  }else{

    $categories_arr = explode(',', $_GET['category']);


    $restaurants = Restaurant::search($db, $_GET['name'], $categories_arr, array(),
              floatval($_GET['rating_min']), floatval($_GET['rating_max']), $_GET['order'], boolval($_GET['asc']) );

    echo json_encode($restaurants);
  }
?>
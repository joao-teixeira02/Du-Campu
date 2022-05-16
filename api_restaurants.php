<?php
  declare(strict_types = 1);

  require_once('database/connection.db.php');
  require_once('database/restaurant.class.php');

  $db = getDatabaseConnection();

  $categories_arr = ;

  $restaurants = Restaurant::search($db, $_GET['name'], $categories_arr, array(), floatval($_GET['rating_min']), floatval($_GET['rating_max']), "" );

  echo json_encode($restaurants);

?>
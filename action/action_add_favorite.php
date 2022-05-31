<?php 

    declare(strict_types = 1);

    require_once(__DIR__ .'/../database/connection.db.php');
    require_once(__DIR__ .'/../utils/session.php');

    $session = new Session();

    $db =  getDatabaseConnection();

    $id_restaurant = $_GET['r_id'];

    $query = 'INSERT INTO FavoriteRestaurant (id_user, id_restaurant) VALUES (:id_user, :id_restaurant)';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':id_user', $session->getUserId());
    $stmt->bindParam(':id_restaurant', $id_restaurant);

    $stmt->execute();

    header("Location:".$_SERVER['HTTP_REFERER']."");
?>
<?php 

    declare(strict_types = 1);

    require_once(__DIR__ .'/../database/connection.db.php');
    require_once(__DIR__ .'/../utils/session.php');

    $session = new Session();

    $db =  getDatabaseConnection();

    $id_dish = $_GET['d_id'];

    $query = 'INSERT INTO FavoriteDish (id_user, id_dish) VALUES (:id_user, :id_dish)';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':id_user', $session->getUserId());
    $stmt->bindParam(':id_dish', $id_dish);

    $stmt->execute();

    header("Location:".$_SERVER['HTTP_REFERER']."");
?>
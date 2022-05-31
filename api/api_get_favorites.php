<?php

    declare(strict_types = 1);
    
    
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $restaurant_ids = array();

    $query = 'SELECT id_restaurant FROM FavoriteRestaurant WHERE id_user=?';

    $stmt = $db->prepare($query);

    $stmt->execute(array($session->getUserId()));

    while ($info = $stmt->fetch()) {
        $restaurant_ids[] = intval($info['id_restaurant']);
    }

    echo json_encode($restaurant_ids);

?>
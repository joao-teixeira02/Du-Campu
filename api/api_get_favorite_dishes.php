<?php

    declare(strict_types = 1);
    
    
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $dish_ids = array();

    $query = 'SELECT id_dish FROM FavoriteDish WHERE id_user=?';

    $stmt = $db->prepare($query);

    $stmt->execute(array($session->getUserId()));

    while ($info = $stmt->fetch()) {
        $dish_ids[] = intval($info['id_dish']);
    }

    echo json_encode($dish_ids);

?>
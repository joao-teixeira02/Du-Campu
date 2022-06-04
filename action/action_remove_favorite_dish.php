<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $id_dish = $_GET['d_id'];

    $query = 'DELETE FROM FavoriteDish WHERE FavoriteDish.id_user=? AND FavoriteDish.id_dish=?';

    $stmt = $db->prepare($query);

    $stmt->execute(array($session->getUserId(), $id_dish));

    header("Location:".$_SERVER['HTTP_REFERER']."");
?>
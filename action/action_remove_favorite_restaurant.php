<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    $db = getDatabaseConnection();

    if (isset($_POST['r_id']) && isset($_POST['csrf'])) {

        if ($_SESSION['csrf'] !== $_POST['csrf']) {
            die;
        }

        $id_restaurant = $_POST['r_id'];

        $query = 'DELETE FROM FavoriteRestaurant WHERE FavoriteRestaurant.id_user=? AND FavoriteRestaurant.id_restaurant=?';

        $stmt = $db->prepare($query);

        $stmt->execute(array($session->getUserId(), $id_restaurant));

    }

    header("Location:".$_SERVER['HTTP_REFERER']."");
?>
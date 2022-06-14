<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    $db = getDatabaseConnection();

    if (isset($_POST['d_id']) && isset($_POST['csrf'])) {

        if ($_SESSION['csrf'] !== $_POST['csrf']) {
            die;
        }

        $id_dish = $_POST['d_id'];

        $query = 'DELETE FROM FavoriteDish WHERE FavoriteDish.id_user=? AND FavoriteDish.id_dish=?';

        $stmt = $db->prepare($query);

        $stmt->execute(array($session->getUserId(), $id_dish));

    }

    header("Location:".$_SERVER['HTTP_REFERER']."");
?>
<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if (isset($_POST['id']) && isset($_POST['csrf'])) {

        if ($_SESSION['csrf'] !== $_POST['csrf']) {
            die;
        }

        $id_restaurant = $_POST['id'];

        $db = getDatabaseConnection();

        $query = 'DELETE FROM Restaurant WHERE Restaurant.id=?';

        $stmt = $db->prepare($query);

        $stmt->execute(array($id_restaurant));

    }

    header('Location: /profile.php?page=myRestaurants');

?>
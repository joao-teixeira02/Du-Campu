<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    if (isset($_GET['id'])) {

        $id_dish = $_GET['id'];

        $session = new Session();

        $db = getDatabaseConnection();

        $query = 'DELETE FROM DishType WHERE DishType.id_dish=?';

        $stmt = $db->prepare($query);

        $stmt->execute(array($id_dish));

        $query = 'DELETE FROM Dish WHERE Dish.id=?';

        $stmt = $db->prepare($query);

        $stmt->execute(array($id_dish));

    }

    header('Location: '. $_SERVER['HTTP_REFERER']);

?>
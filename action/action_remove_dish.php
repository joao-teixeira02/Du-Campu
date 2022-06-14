<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if (isset($_POST['id']) && isset($_POST['csrf'])) {

        if ($_SESSION['csrf'] !== $_POST['csrf']) {
            die;
        }

        $id_dish = $_POST['id'];

        $db = getDatabaseConnection();

        $query = 'DELETE FROM Dish WHERE Dish.id=?';

        $stmt = $db->prepare($query);

        $stmt->execute(array($id_dish));

    }

    header('Location: '. $_SERVER['HTTP_REFERER']);

?>
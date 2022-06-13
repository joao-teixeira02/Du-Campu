<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    if (isset($_POST['id_dish']) && isset($_POST['n']) && isset($_POST['p']) && isset($_POST['t'])) {

        $id_dish = intval($_POST['id_dish']);
        $name = $_POST['n'];
        $price = floatval($_POST['p']);
        $type = $_POST['t'];

        $session = new Session();

        $db = getDatabaseConnection();

        $query = 'INSERT OR IGNORE INTO Type (name) VALUES (:name)'; //insert if not exists

        $stmt = $db->prepare($query);

        $stmt->bindParam(':name', $type);

        $stmt->execute();

        $query = 'SELECT id FROM Type WHERE name=?';

        $stmt = $db->prepare($query);

        $stmt->execute(array($type));

        $id_type = intval($stmt->fetch()['id']);

        $query = 'UPDATE DishType SET id_type = :id_type WHERE id_dish = :id_dish';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id_type', $id_type);
        $stmt->bindParam(':id_dish', $id_dish);

        $stmt->execute();

        $query = 'UPDATE Dish SET name = :name, price = :price WHERE id = :id';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id_dish);

        $stmt->execute();

    }

    header('Location: '. $_SERVER['HTTP_REFERER']);
    
?>
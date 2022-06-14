<?php
	declare(strict_types = 1);

	require_once(__DIR__ .'/../database/connection.db.php');

    $session = new Session();

	$db = getDatabaseConnection();

    if (isset($_POST['n']) && isset($_POST['p']) && isset($_POST['t']) && isset($_POST['id']) && isset($_POST['csrf'])) {

        if ($_SESSION['csrf'] !== $_POST['csrf']) {
            die;
        }

        $name = $_POST['n'];
        $price = $_POST['p'];
        $type = $_POST['t'];
        $restaurant_id = intval($_POST['id']);
        $id_p = 1;

        $query = 'SELECT id FROM Type WHERE Type.name=?';

        $stmt = $db->prepare($query);

        $stmt->execute(array($type));

        $id_type = intval($stmt->fetch()['id']);
    
        $query = 'INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES (:name, :price, :id_photo, :restaurant_id)';
    
        $stmt = $db->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id_photo', $id_p);
        $stmt->bindParam(':restaurant_id', $restaurant_id);

        $stmt->execute();

        $query ='SELECT id FROM Dish WHERE Dish.name=:name AND Dish.restaurant_id=:restaurant_id';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':restaurant_id', $restaurant_id);

        $stmt->execute();

        $id_dish = intval($stmt->fetch()['id']);

        $query = 'INSERT INTO DishType(id_dish, id_type) VALUES (:id_dish, :id_type)';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id_dish', $id_dish);
        $stmt->bindParam(':id_type', $id_type);

        $stmt->execute();
    }
    
	header("Location:".$_SERVER['HTTP_REFERER']."");
?>
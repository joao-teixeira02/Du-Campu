<?php
	declare(strict_types = 1);

	require_once('database/connection.db.php');

	$db = getDatabaseConnection();

    $name = $_GET['n'];
    $price = $_GET['p'];
    $type = $_GET['t'];
    //$path = $_GET['pa'];
    $restaurant_id = 1;

    /*$query = 'INSERT INTO Photo (path) VALUES (:path)';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':path', $path);

    $stmt->execute();

    $query = 'SELECT id FROM Photo WHERE Photo.path=?';

    $stmt->execute(array($path));*/

    $id_photo = 1; //$stmt->fetch()['id'];

    $query = 'INSERT INTO Type (name) VALUES (:type)';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':type', $type);

    $stmt->execute();

    $query = 'SELECT id FROM Type WHERE Type.name=?';

    $stmt = $db->prepare($query);

    $stmt->execute(array($type));

    $id_type = $stmt->fetch()['id'];
 
	$query = 'INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES (:name, :price, :id_photo, :restaurant_id)';
 
	$stmt = $db->prepare($query);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':id_photo', $id_photo);
    $stmt->bindParam(':restaurant_id', $restaurant_id);

    $stmt->execute();

    $query ='SELECT id FROM Dish WHERE Dish.name=:name AND Dish.restaurant_id=:restaurant_id';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':restaurant_id', $restaurant_id);

    $stmt->execute();

    $id_dish = $stmt->fetch()['id'];

    print($id_dish);

    $query = 'INSERT INTO DishType(id_dish, id_type) VALUES (:id_dish, :id_type)';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':id_dish', $id_dish);
    $stmt->bindParam(':id_type', $id_type);

    $stmt->execute();
    
	header('Location: restaurant.php');
?>
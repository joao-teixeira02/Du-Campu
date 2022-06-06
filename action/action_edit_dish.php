<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    $name = $_POST['n'];
    $price = $_POST['p'];

    $session = new Session();

    $db = getDatabaseConnection();

    $query = 'UPDATE Dish SET name = :name, price = :price';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);

    $stmt->execute();

    header('Location: '. $_SERVER['HTTP_REFERER']);
    
?>
<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    $name = $_POST['n'];
    $address = $_POST['a'];
    $price = $_POST['p'];

    $session = new Session();

    $db = getDatabaseConnection();

    $query = 'UPDATE Restaurant SET name = :name, address = :address, price = :price';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':price', $price);

    $stmt->execute();

    header('Location: '. $_SERVER['HTTP_REFERER']);
    
?>
<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $username = $_POST['u'];
    $name = $_POST['n'];
    $mail = $_POST['m'];
    $password = $_POST['p'];
    $address = $_POST['a'];
    $phone = $_POST['ph'];
    
    $query = 'UPDATE User 
    SET username = :username, name = :name, mail = :mail, password = :password, address = :address, phone = :phone
    WHERE username = :oldusername';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':oldusername', $session->getUsername());

    $session->setUsername($username);

    $stmt->execute();

    header('Location: /profile.php');

?>
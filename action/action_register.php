<?php
	declare(strict_types = 1);

	require_once(__DIR__ .'/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

	$db = getDatabaseConnection();

	$username = $_POST['u'];
    $name = $_POST['n'];
    $mail = $_POST['m'];
    $password = $_POST['p'];
    $address = $_POST['a'];
    $phone = $_POST['ph'];
 
	$query = 'INSERT INTO User (username, name, mail, password, address, phone) VALUES (:username, :name, :mail, :password, :address, :phone)';
 
	$stmt = $db->prepare($query);
 
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);

    $stmt->execute();

    session_start();

    $session->setUsername($username);

	header('Location: /index.php');
?>
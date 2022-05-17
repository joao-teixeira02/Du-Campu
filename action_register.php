<?php
	declare(strict_types = 1);

	require_once('database/connection.db.php');

	$db = getDatabaseConnection();

	$username = $_GET['u'];
    $name = $_GET['n'];
    $mail = $_GET['m'];
    $password = $_GET['p'];
    $address = $_GET['a'];
    $phone = $_GET['ph'];
 
	$query = 'INSERT INTO Customer (username, name, mail, password, address, phone) VALUES (:username, :name, :mail, :password, :address, :phone)';
 
	$stmt = $db->prepare($query);
 
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);

    $stmt->execute();

    session_start();

    $_SESSION["username"] = $username;

	header('Location: index.php');
?>
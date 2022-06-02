<?php
	declare(strict_types = 1);

	require_once(__DIR__ .'/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

	$db = getDatabaseConnection();

    $flag = $_POST['flag'];
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

    if ($flag === 0) {
        $query = 'INSERT INTO Customer (id) VALUES (:id)';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $session->getUserId());

        $stmt->execute();
    }
    else if ($flag === 1) {
        $query = 'INSERT INTO Owner (id) VALUES (:id)';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $session->getUserId());

        $stmt->execute();
    }

	header('Location: /index.php');
?>
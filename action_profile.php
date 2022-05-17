<?php
	declare(strict_types = 1);

    require_once('user_session.php');
	require_once('database/connection.db.php');

    $db = getDatabaseConnection();

    $username = $_GET['u'];
    $name = $_GET['n'];
    $mail = $_GET['m'];
    $password = $_GET['p'];
    $address = $_GET['a'];
    $phone = $_GET['ph'];
    
    $query = 'UPDATE Customer 
    SET username = :username, name = :name, mail = :mail, password = :password, address = :address, phone = :phone
    WHERE username = :oldusername';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':oldusername', $_SESSION["username"]);

    $stmt->execute();
    
    $_SESSION["username"] = $username;
    header('Location: profile.php');

?>
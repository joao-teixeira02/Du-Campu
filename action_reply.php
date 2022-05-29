<?php
	declare(strict_types = 1);

	require_once('database/connection.db.php');
	require_once('user_session.php');
 
	$db = getDatabaseConnection();

	$text = $_POST['t'];
	$review_id = $_POST['r'];

	$query = 'SELECT id FROM User WHERE User.username=?';

	$stmt = $db->prepare($query);

	$stmt->execute(array($_SESSION["username"]));

    $owner_id = $stmt->fetch()['id'];

    $query = 'INSERT INTO Reply (text, owner_id, review_id) VALUES (:text, :owner_id, :review_id)';
 
    $stmt = $db->prepare($query);

    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':owner_id', $owner_id);
    $stmt->bindParam(':review_id', $review_id);

    $stmt->execute();

    header('Location: restaurant.php');
?>
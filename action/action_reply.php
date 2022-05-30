<?php
	declare(strict_types = 1);

	require_once(__DIR__ .'/../database/connection.db.php');
	require_once(__DIR__ . '/../utils/session.php');
	$session = new Session();

	$db = getDatabaseConnection();

	$text = $_POST['t'];
	$review_id = $_POST['r'];

	$query = 'SELECT id FROM User WHERE User.username=?';

	$stmt = $db->prepare($query);

	$stmt->execute(array($session->getUsername()));

    $owner_id = $stmt->fetch()['id'];

    $query = 'INSERT INTO Reply (text, owner_id, review_id) VALUES (:text, :owner_id, :review_id)';
 
    $stmt = $db->prepare($query);

    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':owner_id', $owner_id);
    $stmt->bindParam(':review_id', $review_id);

    $stmt->execute();

    header("Location:".$_SERVER['HTTP_REFERER']."");
?>
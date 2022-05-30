<?php
	declare(strict_types = 1);

	require_once(__DIR__ .'/../database/connection.db.php');
	require_once(__DIR__ . '/../utils/session.php');
 
 
	if(ISSET($_POST['r']) && ISSET($_POST['p'])){

		$session = new Session();

		$db = getDatabaseConnection();

		$review = $_POST['r'];
		$points = $_POST['p'];
		$restaurant_id = 1;

		$query = 'SELECT id FROM User WHERE User.username=?';

		$stmt = $db->prepare($query);

		$stmt->execute(array($session->getUsername()));

		$customer_id = $stmt->fetch()['id'];
 
		$query = 'INSERT INTO Reviews (review, customer_id, points, restaurant_id) VALUES (:review, :customer_id, :points, :restaurant_id)';
 
		$stmt = $db->prepare($query);
 
		$stmt->bindParam(':review', $review);
		$stmt->bindParam(':customer_id', $customer_id);
		$stmt->bindParam(':points', $points);
		$stmt->bindParam(':restaurant_id', $restaurant_id);
 
		$stmt->execute();
 
	}
	header('Location: /restaurant.php');
?>
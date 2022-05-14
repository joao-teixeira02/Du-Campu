<?php
	declare(strict_types = 1);

	require_once('database/connection.db.php');
 
 
	if(ISSET($_GET['r']) && ISSET($_GET['p'])){

		$db = getDatabaseConnection();

		$review = $_GET['r'];
		$points = $_GET['p'];
		$restaurant_id = 1;
		$customer_id = 1;
 
		$query = 'INSERT INTO Reviews (review, customer_id, points, restaurant_id) VALUES (:review, :customer_id, :points, :restaurant_id)';
 
		$stmt = $db->prepare($query);
 
		$stmt->bindParam(':review', $review);
		$stmt->bindParam(':customer_id', $customer_id);
		$stmt->bindParam(':points', $points);
		$stmt->bindParam(':restaurant_id', $restaurant_id);
 
		$stmt->execute();
 
	}
	header('Location: restaurant.php');
?>
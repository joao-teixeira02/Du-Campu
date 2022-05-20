<?php
	declare(strict_types = 1);

	require_once('database/connection.db.php');

	$db = getDatabaseConnection();

    $name = $_GET['n'];
    $address = $_GET['a'];
    $owner_id = 1;
    //$path = $_GET['pa'];
    $categories = explode(',', $_GET['c']);

    foreach($categories as $category){
        $query = 'INSERT INTO Category (name) VALUES (:category)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
    }

    /*$query = 'INSERT INTO Photo (path) VALUES (:path)';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':path', $path);

    $stmt->execute();

    $query = 'SELECT id FROM Photo WHERE Photo.path=?';

    $stmt->execute(array($path));*/

    $id_photo = 1; //$stmt->fetch()['id'];
 
	$query = 'INSERT INTO Restaurant (name, address, owner_id) VALUES (:name, :address, :owner_id)';
 
	$stmt = $db->prepare($query);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':owner_id', $owner_id);;

    $stmt->execute();

    $query = 'SELECT id FROM Restaurant WHERE Restaurant.name=?';

    $stmt = $db->prepare($query);

    $stmt->execute(array($name));

    $id_restaurant = $stmt->fetch()['id'];

    $query = 'INSERT INTO RestaurantPhoto (id_restaurant, id_photo) VALUES (:id_restaurant, :id_photo)';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':id_restaurant', $id_restaurant);
    $stmt->bindParam(':id_photo',$id_photo);

    $stmt->execute();

    $query1 = 'INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (:id_restaurant, :id_category)';
    $query2 = 'SELECT id FROM Category WHERE Category.name=?';

    foreach($categories as $category) {
        $stmt1 = $db->prepare($query1);
        $stmt2 = $db->prepare($query2);

        $stmt2->execute(array($category));
        $id_category = $stmt2->fetch()['id'];

        $stmt1->bindParam(':id_restaurant', $id_restaurant);
        $stmt1->bindParam(':id_category', $id_category);

        $stmt1->execute();
    }
    
	header('Location: index.php');
?>
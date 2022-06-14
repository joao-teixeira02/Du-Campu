<?php
	declare(strict_types = 1);

	require_once(__DIR__ .'/../database/connection.db.php');
	require_once(__DIR__ .'/../database/category.class.php');
	require_once(__DIR__ .'/../database/photo.class.php');
    require_once(__DIR__ .'/../utils/session.php');

    //TODO NAO DEIXAR Q UM ATRASADO ADICIONE RESTAURANTE SEM ESTAR LOGIN
    $session = new Session();
    
	$db = getDatabaseConnection();

    if(! ( isset($_POST['n']) && isset($_POST['a']) && isset($_POST['classification']) && isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error']!==0 && isset($_POST['csrf']))){
        print_r("Erro");
        die;
    }

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        die;
    }

    $name = $_POST['n'];
    $address = $_POST['a'];
    $classification = $_POST['classification'];
    print_r($classification);
    
    $owner_id = $session->getUserId();

    $categories = Category::getCategories($db);
    
    $categories_idlist = [];

    foreach($categories as $category){
        if(isset($_POST[$category->name]) && $_POST[$category->name] === 'on'){
            $categories_idlist[] = $category->id;
        }
        
    }

    if(empty($categories_idlist)){
        
	    header("Location: ".$_SERVER['HTTP_REFERER']);
        die;
    }
 
 
	$stmt = $db->prepare('INSERT INTO Restaurant (name, address, owner_id, price) VALUES (:name, :address, :owner_id, :price)');

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':owner_id', $owner_id);
    $stmt->bindParam(':price', $classification);

    $success = $stmt->execute();

    if(! $success){
        header("Location: ".$_SERVER['HTTP_REFERER']);
        die;
    }
    $id_restaurant = $db->lastInsertId();

    /* CRIAR IMAGEM */
    $originalFileName = 'restaurant_'. $id_restaurant . '_photo.png';

    $id_photo = Photo::insertPhoto($db, $_FILES['fileToUpload'], $originalFileName);

    $stmt = $db->prepare('INSERT INTO RestaurantPhoto (id_restaurant, id_photo) VALUES (:id_restaurant, :id_photo)');
    $stmt->bindParam(':id_restaurant', $id_restaurant);
    $stmt->bindParam(':id_photo',$id_photo);
    $stmt->execute();


    foreach($categories_idlist as $id_category) {
        $stmt1 = $db->prepare('INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (:id_restaurant, :id_category)');
        $stmt1->bindParam(':id_category', $id_category);
        $stmt1->bindParam(':id_restaurant', $id_restaurant);

        $stmt1->execute();
    }
    
	header("Location: ".$_SERVER['HTTP_REFERER']);
?>
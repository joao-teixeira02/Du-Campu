<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/photo.class.php');
    require_once(__DIR__ . '/../database/category.class.php');
    require_once(__DIR__ . '/../utils/session.php');

    if(!(isset($_POST['id_restaurant']) && isset($_POST['n']) && isset($_POST['a']) && isset($_POST['classification']) && isset($_POST['csrf']))){
        
        print_r("Erro");
        die;
    }

    $session = new Session();

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        die();
    }

    $db = getDatabaseConnection();

    $id_restaurant = intval($_POST['id_restaurant']);
    $name = $_POST['n'];
    $address = $_POST['a'];
    $price = intval($_POST['classification']);

    /* CRIAR IMAGEM */
    if(isset($_FILES['fileToUpload'])){
        $originalFileName = 'restaurant_'. $id_restaurant . '_photo.png';

        $id_photo = Photo::insertPhoto($db, $_FILES['fileToUpload'], $originalFileName);
        
    }



    $query = 'UPDATE Restaurant SET name = :name, address = :address, price = :price WHERE id = :id';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':id', $id_restaurant);

    $stmt->execute();


    /* categories */

    $categories = Category::getCategories($db);
    foreach($categories as $category){
        if(isset($_POST[$category->name]) && $_POST[$category->name] === 'on'){
            $categories_idlist[] = $category->id;
        }
        
    }

    $stmt1 = $db->prepare('DELETE FROM RestaurantCategory WHERE id_restaurant = :id_restaurant');
    $stmt1->bindParam(':id_restaurant', $id_restaurant);
    $stmt1->execute();

    foreach($categories_idlist as $id_category) {
        $stmt1 = $db->prepare('INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (:id_restaurant, :id_category)');
        $stmt1->bindParam(':id_category', $id_category);
        $stmt1->bindParam(':id_restaurant', $id_restaurant);

        $stmt1->execute();
    }

    header('Location: '. $_SERVER['HTTP_REFERER']);
    
?>
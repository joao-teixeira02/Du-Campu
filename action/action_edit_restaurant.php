<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../utils/session.php');

    if(!(isset($_POST['id_restaurant']) && isset($_POST['n']) && isset($_POST['a']) && isset($_POST['classification']))){
        
        print_r("Erro");
        //header('Location: '. $_SERVER['HTTP_REFERER']);
        die;
    }


    $id_restaurant = intval($_POST['id_restaurant']);
    $name = $_POST['n'];
    $address = $_POST['a'];
    $price = intval($_POST['classification']);

    print_r($id_restaurant);
    print_r($name);
    print_r($address);
    print_r($price);


    $session = new Session();

    $db = getDatabaseConnection();

    $query = 'UPDATE Restaurant SET name = :name, address = :address, price = :price WHERE id = :id';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':id', $id_restaurant);

    $stmt->execute();

    header('Location: '. $_SERVER['HTTP_REFERER']);
    
?>
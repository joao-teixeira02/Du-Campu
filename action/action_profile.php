<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/photo.class.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    $db = getDatabaseConnection();


    /* CRIAR IMAGEM */
    if(isset($_FILES['fileToUpload'])){
        $originalFileName = $session->getUsername() . '_photo.png';

        $id_photo = Photo::insertPhoto($db, $_FILES['fileToUpload'], $originalFileName);

        $query = 'UPDATE User SET photo = :photo_id WHERE id = :id_u';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':photo_id', $id_photo);
        $stmt->bindParam(':id_u', $session->getUserId());
        $stmt->execute();
    }


    if(isset($_POST['u']) && isset($_POST['n']) && isset($_POST['m']) && isset($_POST['p']) && isset($_POST['a']) && isset($_POST['ph'])){

        $username = $_POST['u'];
        $name = $_POST['n'];
        $mail = $_POST['m'];
        $password = $_POST['p'];
        $address = $_POST['a'];
        $phone = $_POST['ph'];

        
        $query = 'UPDATE User 
        SET username = :username, name = :name, mail = :mail, password = :password, address = :address, phone = :phone
        WHERE username = :oldusername';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':oldusername', $session->getUsername());

        $session->setUsername($username);

        $stmt->execute();
    }
    header('Location: '. $_SERVER['HTTP_REFERER']);

?>
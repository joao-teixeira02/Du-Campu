<?php
	declare(strict_types = 1);

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();

    if (isset($_POST['csrf'])) {

        if ($_SESSION['csrf'] !== $_POST['csrf']) {
            die();
        }

        $db = getDatabaseConnection();

        $query = 'DELETE FROM User WHERE User.id=?';

        $stmt = $db->prepare($query);

        $stmt->execute(array($session->getUserId()));

        $session->logout();
    }

    header("Location: /index.php");

?>
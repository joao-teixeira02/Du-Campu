<?php
    declare(strict_types = 1);
    require_once(__DIR__ .'/../utils/session.php');
    require_once(__DIR__ .'/../database/connection.db.php');
    require_once(__DIR__ .'/../database/user.class.php');

    if (isset($_POST['csrf'])) {

        $session = new Session();

        if ($_SESSION['csrf'] !== $_POST['csrf']) {
            die();
        }

        function validateLogin(string $username, string $password) : bool{
            $db = getDatabaseConnection();

            $user = User::getUser($db, $username);

            if($user === null){
                return false;
            }

            return password_verify($password, $user->password);
        }


        // validate login
        if (isset($_POST['u']) && isset($_POST['p'])){
            if(validateLogin($_POST['u'], $_POST['p'])){
                $session->setUsername($_POST['u']);
                header('Location: /index.php');
                exit();
            }
            else {
                $session->addMessage('error', 'Wrong password!');
            }
        }
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
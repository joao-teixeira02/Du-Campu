<?php
    declare(strict_types = 1);
    session_start();

    require_once('user_session.php');
    require_once('database/connection.db.php');
    require_once('database/user.class.php');

    function validateLogin(string $username, string $password) : bool{
        $db = getDatabaseConnection();

        $user = User::getUser($db, $username);

        if($user === null){
            return false;
        }

        return $user->password === $password;
    }


    // validate login
    if (isset($_POST['u']) && isset($_POST['p'])){
        if(validateLogin($_POST['u'], $_POST['p'])){
            $_SESSION["username"] = $_POST['u']; 
            header('Location: ' . "index.php");
            exit();
        }
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
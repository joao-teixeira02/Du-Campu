<?php

    declare(strict_types = 1);

    require_once('database/connection.db.php');

    session_start();


    function isLogged() : bool{
        return isset($_SESSION["username"]);
    }

    function getUserId() : ?int {
        $db = getDatabaseConnection();

        $stmt = $db->prepare('SELECT id FROM User WHERE User.username=?');
        $stmt->execute(array($_SESSION["username"]));
        return intval($stmt->fetch()['id']);
    }

    function getUsername() : ?string{
        if(isLogged() === TRUE){
            return $_SESSION["username"];
        }
        return "";
    }

    function getName() : ?string{
        if(isLogged() === TRUE){
            $db = getDatabaseConnection();
            $stmt = $db->prepare('SELECT name FROM User WHERE User.username=?');
            $stmt->execute(array($_SESSION["username"]));
            return $stmt->fetch()['name'];
        }
        return "";
    }

    function getEmail() : ?string{
        if(isLogged() === TRUE){
            $db = getDatabaseConnection();
            $stmt = $db->prepare('SELECT mail FROM User WHERE User.username=?');
            $stmt->execute(array($_SESSION["username"]));
            return $stmt->fetch()['mail'];
        }
        return "";
    }

    function getPassword() : ?string{
        if(isLogged() === TRUE){
            $db = getDatabaseConnection();
            $stmt = $db->prepare('SELECT password FROM User WHERE User.username=?');
            $stmt->execute(array($_SESSION["username"]));
            return $stmt->fetch()['password'];
        }
        return "";
    }

    function getPhone() : ?string{
        if(isLogged() === TRUE){
            $db = getDatabaseConnection();
            $stmt = $db->prepare('SELECT phone FROM User WHERE User.username=?');
            $stmt->execute(array($_SESSION["username"]));
            return $stmt->fetch()['phone'];
        }
        return "";
    }

    function getAddress() : ?string{
        if(isLogged() === TRUE){
            $db = getDatabaseConnection();
            $stmt = $db->prepare('SELECT address FROM User WHERE User.username=?');
            $stmt->execute(array($_SESSION["username"]));
            return $stmt->fetch()['address'];
        }
        return "";
    }

?>
<?php
    session_start();

    function validateLogin(string $username, string $password) : bool{
        return true;
    }

    function isLogged() : bool{
        return isset($_SESSION["username"]);
    }

    function getUsername() : string{
        if(isLogged() === TRUE){
            return $_SESSION["username"];
        }
        return "none";
    }

?>
<?php

    session_start();


    function isLogged() : bool{
        return isset($_SESSION["username"]);
    }

    function getUsername() : string{
        if(isLogged() === TRUE){
            return $_SESSION["username"];
        }
        return "none";
    }

    function logout(){
        $_SESSION["username"] = "";
        session_destroy();
    }

?>
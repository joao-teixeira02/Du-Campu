<?php
    declare(strict_types = 1);

    require_once(__DIR__ . "/../cart.class.php");

    class Session{
        public Cart $cart;

        public function __construct(){
            session_start();
            if(!isset($_SESSION["cart"])){
                $this->cart = new Cart;
                $this->saveCart();
            }
            $this->loadCart();
        }
        
        public function saveCart(){
            $_SESSION["cart"] = serialize($this->cart);
        }

        public function loadCart(){
            if(isset($_SESSION["cart"])){
                $this->cart = unserialize($_SESSION["cart"]);
            }
        }

        public function isLogged() : bool{
            return isset($_SESSION["username"]);
        }

        function getUsername() : string{
            if(isLogged() === TRUE){
                return $_SESSION["username"];
            }
            return "";
        }

        function setUsername(string $username) {
            $_SESSION["username"] = $username;
        }

        function logout(){
            session_destroy();
        }

    }


?>
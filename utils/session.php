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

        function getUserId() : ?int {
            $db = getDatabaseConnection();
    
            $stmt = $db->prepare('SELECT id FROM User WHERE User.username=?');
            $stmt->execute(array($_SESSION["username"]));
            return intval($stmt->fetch()['id']);
        }
    
        function getName() : ?string{
            if($this->isLogged() === TRUE){
                $db = getDatabaseConnection();
                $stmt = $db->prepare('SELECT name FROM User WHERE User.username=?');
                $stmt->execute(array($_SESSION["username"]));
                return $stmt->fetch()['name'];
            }
            return "";
        }
    
        function getEmail() : ?string{
            if($this->isLogged() === TRUE){
                $db = getDatabaseConnection();
                $stmt = $db->prepare('SELECT mail FROM User WHERE User.username=?');
                $stmt->execute(array($_SESSION["username"]));
                return $stmt->fetch()['mail'];
            }
            return "";
        }
    
        function getPassword() : ?string{
            if($this->isLogged() === TRUE){
                $db = getDatabaseConnection();
                $stmt = $db->prepare('SELECT password FROM User WHERE User.username=?');
                $stmt->execute(array($_SESSION["username"]));
                return $stmt->fetch()['password'];
            }
            return "";
        }
    
        function getPhone() : ?string{
            if($this->isLogged() === TRUE){
                $db = getDatabaseConnection();
                $stmt = $db->prepare('SELECT phone FROM User WHERE User.username=?');
                $stmt->execute(array($_SESSION["username"]));
                return $stmt->fetch()['phone'];
            }
            return "";
        }
    
        function getAddress() : ?string{
            if($this->isLogged() === TRUE){
                $db = getDatabaseConnection();
                $stmt = $db->prepare('SELECT address FROM User WHERE User.username=?');
                $stmt->execute(array($_SESSION["username"]));
                return $stmt->fetch()['address'];
            }
            return "";
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
            if($this->isLogged() === TRUE){
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
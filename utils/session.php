<?php
    declare(strict_types = 1);

    require_once(__DIR__ . "/../database/cart.class.php");
    require_once(__DIR__ . "/../database/connection.db.php");

    function generate_random_token() {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }

    class Session{
        public Cart $cart;
        private array $messages;

        public function __construct(){
            session_set_cookie_params(0, '/', $_SERVER['HTTP_HOST'], true, true);
            session_start();
            if (!isset($_SESSION['csrf'])) {
                $_SESSION['csrf'] = generate_random_token();
            }
            if(!isset($_SESSION["cart"])){
                $this->cart = new Cart;
                $this->saveCart();
            }
            $this->loadCart();
            $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
            unset($_SESSION['messages']);
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

        public function addMessage(string $type, string $text) {
            $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
        }
      
        public function getMessages() {
            return $this->messages;
        }

    }


?>
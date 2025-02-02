<?php
    function generate_random_token() {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }

    class Session {
        private array $messages;

        public function __construct() {
            session_status() === PHP_SESSION_ACTIVE ?: session_start();

            $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
            unset($_SESSION['messages']);

            if (!isset($_SESSION['csrf'])) {
                $_SESSION['csrf'] = generate_random_token();
            }
        
        }

        public function isLoggedIn() : bool {
        return isset($_SESSION['id']);    
        }

        public function logout() {
        session_destroy();
        }

        public function getId() : ?int {
        return isset($_SESSION['id']) ? $_SESSION['id'] : null;    
        }

        public function getName() : ?string {
        return isset($_SESSION['name']) ? $_SESSION['name'] : null;
        }

        public function getAdmin() : ?bool {
        return isset($_SESSION['admin']) ? $_SESSION['admin'] : null;
        }

        public function setId(int $id) {
        $_SESSION['id'] = $id;
        }

        public function getCSRF() {
        return isset($_SESSION['csrf']) ? $_SESSION['csrf'] : null;  
        }

        public function setName(string $name) {
        $_SESSION['name'] = $name;
        }

        public function setAdmin(bool $admin) {
        $_SESSION['admin'] = $admin;
        }

        public function setCart(array $cart){
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = array();
            }
            $_SESSION['cart'] = $cart;
        }
        public function getCart() : ?array{
            if(!isset($_SESSION['cart'])){
                return array();
            }
            return $_SESSION['cart'];
        }

        public function setFavorites(array $favorites){
            if(!isset($_SESSION['favorites'])){
                $_SESSION['favorites'] = array();
            }
            $_SESSION['favorites'] = $favorites;
        }
        public function getFavorites() : ?array{
            if(!isset($_SESSION['favorites'])){
                return array();
            }
            return $_SESSION['favorites'];
        }

        public function addMessage(string $type, string $text) {
        $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
        }

        public function getMessages() {
        return $this->messages;
        }
    }
?>
<?php
    class Session {
        private array $messages;

        public function __construct() {
        session_status() === PHP_SESSION_ACTIVE ?: session_start();

        $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
        unset($_SESSION['messages']);
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

        public function setName(string $name) {
        $_SESSION['name'] = $name;
        }

        public function setAdmin(bool $admin) {
        $_SESSION['admin'] = $admin;
        }

        public function setCart(array $cart){
            $_SESSION['cart'] = $cart;
        }
        public function getCart() : ?array{
            return $_SESSION['cart'];
        }

        public function addMessage(string $type, string $text) {
        $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
        }

        public function getMessages() {
        return $this->messages;
        }
    }
?>
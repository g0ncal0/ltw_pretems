<?php

declare(strict_types = 1);
require_once('util.php');

function getMessages(PDO $db, string $productId, string $buyerId) : array {
    return fetchAll($db, 'SELECT * FROM messages WHERE productId = ? AND buyerId = ?', array($productId, $buyerId));
}

function addMessage(PDO $db, string $productId, string $buyerId, int $fromBuyer, string $message) : void {
    execute($db, 'INSERT INTO messages (productId, buyerId, fromBuyer, message, date) VALUES (?, ?, ?, ?, ?)', array($productId, $buyerId, $fromBuyer, $message, date("Y-m-d H:i")));
}

function getMessage(PDO $db, string $productId, string $buyerId, int $fromBuyer, string $message) : array {
    return fetch($db, 'SELECT * FROM messages WHERE productId = ? AND buyerId = ? AND fromBuyer = ? AND message = ? ORDER BY id DESC', array($productId, $buyerId, $fromBuyer, $message));
}    

function getChats(PDO $db, int $productId) : array {
    return fetchAll($db, 'SELECT DISTINCT users.id, users.username, users.profileImg FROM users JOIN messages ON users.id = messages.buyerId WHERE messages.productId = ?', array($productId));
}

?>
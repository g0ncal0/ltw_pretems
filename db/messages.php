<?php

require_once('util.php');

function getMessages($db, $productId, $buyerId) {
    return fetchAll($db, 'SELECT * FROM messages WHERE productId = ? AND buyerId = ?', array($productId, $buyerId));
}

function addMessage($db, $productId, $buyerId, $fromBuyer, $message) {
    execute($db, 'INSERT INTO messages (productId, buyerId, fromBuyer, message, date) VALUES (?, ?, ?, ?, ?)', array($productId, $buyerId, $fromBuyer, $message, date("Y-m-d H:i")));
}

function getMessage($db, $productId, $buyerId, $fromBuyer, $message) {
    return fetch($db, 'SELECT * FROM messages WHERE productId = ? AND buyerId = ? AND fromBuyer = ? AND message = ? ORDER BY id DESC', array($productId, $buyerId, $fromBuyer, $message));
}    

function getChats($db, $productId) {
    return fetchAll($db, 'SELECT DISTINCT users.id, users.username, users.profileImg FROM users JOIN messages ON users.id = messages.buyerId WHERE messages.productId = ?', array($productId));
}

?>
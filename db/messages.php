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
?>
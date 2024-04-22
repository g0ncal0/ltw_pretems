<?php 

function getMessages($db, $productId, $buyerId) {
    return fetchAll($db, 'SELECT * FROM messages WHERE productId = ? AND buyerId = ?', array($productId, $buyerId));
}

?>
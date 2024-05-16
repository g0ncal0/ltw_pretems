<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../include.php');

$session = new Session();

protectAPIloggedIN($session);
$db = getDatabaseConnection();

$productId = $_GET['productId'];
$buyerId = $_GET['buyerId'];
$lastTime = htmlentities($_GET['lastTime']);

$newMessages = getNewMessages($db, $productId, $buyerId, $lastTime);

echo json_encode($newMessages);

?>

<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../include.php');

  $session = new Session();

  $db = getDatabaseConnection();

  $product = getProduct($db, $_POST['productId']);
  $fromBuyer = null;
  
  if ($product['user'] == $_POST['buyerId']) $fromBuyer = 0;
  else $fromBuyer = 1;

  addMessage($db, $_POST['productId'], $_POST['buyerId'], $fromBuyer, $_POST['message']);
  $newMessage = getMessage($db, $_POST['productId'], $_POST['buyerId'], $fromBuyer, $_POST['message']);

  echo json_encode($newMessage);
?>
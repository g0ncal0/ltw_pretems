<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../include.php');

  $session = new Session();

  protectAPIloggedIN($session);
  $db = getDatabaseConnection();

  $product = getProduct($db, $_POST['productId']);
  $fromBuyer = null;

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    errorAPI("Invalid");
    return;
  }

  if(((int)$_POST['buyerId'] !== $session->getId()) && ($session->getId() !== $product['user'])){
    errorAPI("Unauthorized");
    die();
  }

  if ($session->getCSRF() !== $_POST['csrf']) {
    throw new Exception('CSRF token is invalid.');
  }
  
  if ($product['user'] == $session->getId()) $fromBuyer = 0;
  else $fromBuyer = 1;

  addMessage($db, $_POST['productId'], $_POST['buyerId'], $fromBuyer, $_POST['message']);
  $newMessage = getMessage($db, $_POST['productId'], $_POST['buyerId'], $fromBuyer, $_POST['message']);

  echo json_encode($newMessage);
?>
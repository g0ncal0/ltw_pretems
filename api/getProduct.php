<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../include.php');

  $session = new Session();

  $db = getDatabaseConnection();

  $product = getProduct($db, $_GET['productId']);

  echo json_encode($product);
?>
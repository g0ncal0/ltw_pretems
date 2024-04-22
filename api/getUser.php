<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../include.php');

  $session = new Session();

  $db = getDatabaseConnection();

  $user = getProduct($db, $_GET['userId']);

  echo json_encode($user);
?>
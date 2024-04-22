<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../include.php');

  $session = new Session();

  $db = getDatabaseConnection();

  $user = getUser($db, $_GET['userId']);

  echo json_encode($user);
?>
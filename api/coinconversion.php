<?php

    require_once(__DIR__ . '/../include.php');
    header('Content-Type: application/json');

    $session = new Session();

    protectAPIloggedIN($session);


    // Let's imagine that 1€ = 1.08 dollars
    // 1€ = 0.99 Switz Frank
    // 1€ = 0.85 british pounds

    $amount = $_GET['amount'];

    $res = array();
    $res['dollar'] = 1.08 * $amount;
    $res['frank'] = 0.99 * $amount;
    $res['pound'] = 0.85 * $amount;

    echo json_encode($res);
?>
<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../include.php');

  $session = new Session();


  $value = $_POST['value'];
  $db = getDatabaseConnection();
  if(empty($_POST['discount']) || empty($value) || !isset($_POST['discount']) || !isset($value)){
    errorAPI("Not valid");
    die();
  }

  $discount = getDiscountInfo($db, $_POST['discount']);

  if(!isset($discount) || empty($discount)){
    $r['error'] = 'Not valid code';
    echo json_encode($r);
    die();
  }
  $res = $value;
  if($value > $discount['minamount']){
    $dsv = $value * ($discount['percentage'] / 100);
    if($dsv > $discount['maxdiscount']){
        $dsv = $discount['maxdiscount'];
    }
    $res -= $dsv;
    if($dsv == 0){
        $r['error'] = 'The min amount was not met.';
        echo json_encode($r);
        die();
    }
  }else{
    $r['error'] = 'The min amount of ' . $discount['minamount'] . '€ was not met.';
    echo json_encode($r);
    die();
  }
  

  $result['result'] = $res;
  $result['error'] = "Success";
  echo json_encode($result);
?>
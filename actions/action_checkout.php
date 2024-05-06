<?php
require_once(__DIR__ . '/../include.php'); 

$session = new Session();

protectActionloggedIn($session);

$db = getDatabaseConnection();

$cart = getCart($db, $session);

$discount = $_POST['discount'];
$address = $_POST['delivery'];
$zipcode = $_POST['zipcode'];

if(!isset($cart) || empty($cart)){
    errorAPI("No items..");
    exit;
}
// check if elements are all available

foreach($cart as $item){
    if(!checkItemAvailable($db, $item['id'])){
        errorAPI("One or more item is not available anymore!");
        exit;
    }
}


// start by setting the elements as unavailable
$sum = 0;
foreach($cart as $item){
    $price = setItemUnavailable($db, $item['id']); // returns price of item
    $sum += $price;
}

// get the discount code

$dicountinfo = getDiscountInfo($db, $discount);

// return how much to pay

if(isset($dicountinfo['percentage'])){
    $amount_discount = $sum * $discountinfo['percentage'];
    if($amount_discount > $discountinfo['maxdiscount']){
        $amount_discount = $discountinfo['maxdiscount'];
    }
    if($sum < $discountinfo['minamount']){
        $amount_discount = 0;
    }
    $sum = $sum - $amount_discount;
}

// Create purchase & set status of purchase as pending

$idpurchase = md5($session->getId() . date("Y-m-d H:i:s"));

purchase($db, $idpurchase, $session->getId(), $cart, $zipcode, $address, $sum);
emptyCart($db, $session->getId());

header('Location: /purchase.php?id='. $idpurchase);


?>
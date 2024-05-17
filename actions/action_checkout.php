<?php
require_once(__DIR__ . '/../include.php'); 

$session = new Session();

protectActionloggedIn($session);

$db = getDatabaseConnection();

$cart = getCart($db, $session);

$discount = $_POST['discount'];
$address = $_POST['delivery'];
$zipcode = $_POST['zipcode'];



if ($session->getCSRF() !== $_POST['csrf']) {
    throw new Exception('CSRF token is invalid.');
}
else if(!isset($cart) || empty($cart)){
    header('Location: ../cart.php?error=noCart');
}
// check if elements are all available

else 
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

$discountinfo = getDiscountInfo($db, $discount);

// return how much to pay

if(isset($discountinfo['percentage'])){
    $amount_discount = $sum * ($discountinfo['percentage'] / 100);
    if($amount_discount > $discountinfo['maxdiscount']){
        $amount_discount = $discountinfo['maxdiscount'];
    }
    if($sum < $discountinfo['minamount']){
        $amount_discount = 0;
    }
    $sum = $sum - $amount_discount;
}
$sum = round($sum, 2);

// Create purchase & set status of purchase as pending

$idpurchase = md5($session->getId() . date("Y-m-d H:i:s"));

purchase($db, $idpurchase, $session->getId(), $cart, $zipcode, $address, $sum);
emptyCart($db, $session->getId());

foreach($cart as $item){
    addMessage($db, $item['id'], $session->getId(), 1, "**THIS IS AN AUTOMATIC MESSAGE** \n I HAVE JUST BOUGHT YOUR ITEM.");
    addMessage($db, $item['id'], $session->getId(), 1, "SEND IT TO ". $address . " at " . $zipcode .". Thank you.");

}


header('Location: /purchase.php?id='. $idpurchase);


?>
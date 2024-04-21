<?php
require_once(__DIR__ . '/../include.php'); 

$session = new Session();

protectAPIloggedIN($session);


$cart = $_POST['cart']; // receive [item1Index, item2Index,...]
$discount = $_POST['discount'];

if(!isset($cart)){
    exit;
}
// check if elements are all available

foreach($cart as $item){
    if(!$item){ // TODO: correct if
        errorAPI("One or more item is not available anymore!");
        exit;
    }
}


// start by setting the elements as unavailable
$sum = 0;
foreach($cart as $item){
    $price = setItemUnavailable($item);
    if($price === -1){
        errorAPI("Unexplainable error.");
    }
    $sum += $price['price'];
}

// get the discount code

//$dicountinfo = getDiscountInfo($discount);

// return how much to pay



// set status of purchase as pending


?>
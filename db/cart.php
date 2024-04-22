<?php

require_once(__DIR__ . '/util.php');

function getCart($db, $session){
    if($session->isLoggedIn()){
        $ci = fetchAll($db, 'SELECT product FROM cart WHERE user = ?', array($session->getId()));
        if(!isset($ci)){
            return array();
        }
        if(count($ci) == 0){
            return array();
        }
        $elements = array();
        foreach($ci as $citem){
            array_push($elements, $citem['product']);
        }
        $cart_items = getItemsOnIDs($db, $elements);

        return $cart_items;
    }else{
        $cart = $session->getCart();
        if(!isset($cart)){
            return array();
        }
        if(count($cart) == 0){
            return array();
        }
        $cart_items = getItemsOnIDs($db, $cart);
        return $cart_items;
    }

}


function purchase($db, $idPurchase, $userId, $products, $zipcode, $address){
    execute($db, 'INSERT INTO purchases VALUES (?, ?, ?, ?, ?, ?)', array($idPurchase, date('Y-m-d H:i:s'), 0, $address, $zipcode, $userId));
    foreach($products as $product){
        execute($db, 'INSERT INTO purchaseItems VALUES (?, ?)', array($idPurchase, $product['id']));
    }
}

?>

<?php 
    require_once('include.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $id = $_GET['id'];
    if(!isset($id) || $id === ""){
        $id = $session->getId();
    }

    $profile = getUser($db, $id);

    output_header($db,  $profile['name'] . "'s Profile", null, $session->getId());

    if ($session->isLoggedIn() && ($id == $session->getId())) {
        $purchases = getPurchases($db, $session->getId());
        $favorites = getFavorites($db, $session);
        $selling_items = getSellingProductsOfUser($db, $id);
        $sold_items = getSoldProductsOfUser($db, $id);
        if (isAdmin($db, $session->getId())){ 
            output_profile_logged_admin($profile, $favorites, $selling_items, $sold_items);
        }   
        else{
            output_profile_logged($profile, $favorites, $selling_items, $sold_items);
        }
        output_profile_purchases($purchases);
    }
    else{
        $selling_items = getSellingProductsOfUser($db, $id);
        output_profile_other_user($profile, $selling_items);
    }

   
    output_footer();
?>
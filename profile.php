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
    protectPage($session);

    if ($session->isLoggedIn() && ($id == $session->getId())) {
        $selling_items = getSellingProductsOfUser($db, $id);
        $sold_items = getSoldProductsOfUser($db, $id);
        if (isAdmin($db, $session->getId())){ //TODO: remove admin attribute from session (and change login and register)
            output_profile_logged_admin($profile, $selling_items, $sold_items);
        }   
        else{
            output_profile_logged($profile, $selling_items, $sold_items);
        }
    }
    else{
        output_profile_other_user($profile);
    }
   
    output_footer();
?>
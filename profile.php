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
    
    protectPage();


    output_profile($profile);

    if ($session->isLoggedIn() && ($id == $session->getId())) { ?>
        <a href="changeProfile.php"><button>Change Profile</button></a>
        <a href="addProduct.php"><button>Add Product</button></a>
    <?php }

    output_footer();
?>
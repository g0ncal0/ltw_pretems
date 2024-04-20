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
        <a href="changeProfile.php"><button class="button">Change Profile</button></a>
        <a href="addProduct.php"><button class="button">Add Product</button></a><?php 
        
        if ($session->getAdmin()){
            ?><a href="add_category.php"><button class="button">Add Category</button></a>
            <a href="manage_users.php"><button class="button">Manage Users</button></a><?php //TODO: Implement (+ create file) 
            echo "<h2>You are an admin</h2>"; // TODO: Temporary
        }
    }

    output_footer();
?>
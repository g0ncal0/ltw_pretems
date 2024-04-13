<?php 
    require_once('include.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $id = $_GET['id'];
    $profile = getUser($db, $id);

    output_header($db, 'Profile', null);
    output_profile($profile);

    if ($session->isLoggedIn() && ($id == $session->getId())) { ?>
        <h1>HIIIII</h1>
    <?php }

    // have logic: if user is current user, have option for edition
    output_footer();
?>
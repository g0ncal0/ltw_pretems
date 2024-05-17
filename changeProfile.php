<?php 
    require_once('include.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $id = $session->getId();
    $profile = getUser($db, $id);

    output_header($db, 'Change Profile', null, $session->getId()); 
    protectPage($session);

    
    ?>

    <section class="container">
        
        <h1>Change Profile:</h1>
        <form class="profile-form" action="/actions/action_change_profile.php" method="post" enctype="multipart/form-data">
            <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $profile['name']; ?>">

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" value="<?php echo $profile['email']; ?>">

            <label for="newPassword">Password:</label>
            <input type="password" name="newPassword" id="newPassword">

            <label for="image">Profile Picture:</label>
            <input type="file" name="image">

            <label for="currentPassword">You must type your current password to perform changes:</label>
            <input type="password" name="currentPassword" id="currentPassword">

            <button class="button" type="submit">Save Changes</button>
        </form>
    </section>    

    <?php output_footer();
?>
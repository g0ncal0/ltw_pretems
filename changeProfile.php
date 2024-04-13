<?php 
    require_once('include.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $id = $session->getId();
    $profile = getUser($db, $id);

    output_header($db, 'Change Profile', null); ?>

    <form class="profile-form" action="/actions/action_change_profile.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $profile['name']; ?>">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" value="<?php echo $profile['email']; ?>">
        <label for="senha">Password:</label>
        <input type="password" name="password" id="password">
        <button class="button" type="submit">Save Changes</button>
    </form>

    <?php output_footer();
?>
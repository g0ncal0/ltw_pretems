<?php 
    require_once('include.php');
    $session = new Session();

    $db = getDatabaseConnection();

    output_header($db, "Register", null, $session->getId(), $session);

?>



    <section class="container" >
        <h1>Register a new account</h1>
        <?php 
        $error = $_GET['error'];
        if (($error == 'InvalidEmail') || ($error == 'InvalidEmailAndUsername')) echo '<p class="error-message">Sorry, that email is already being used.';
        if (($error == 'InvalidUsername') || ($error == 'InvalidEmailAndUsername')) echo '<p class="error-message">Sorry, that username is already being used.';
        if ($error == 'InvalidBlockedUser') echo '<p class="error-message">Sorry, you are blocked for not respecting the rules of our site.';
        ?>
        <form id="register-account" class="account-form" action="actions/action_register.php" method="post">
            <input type="hidden" id="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

            <label for="name">Name</label>
            <input required type="text" name="r-name" id="r-name">

            <label for="username">Username</label>
            <input required type="text" name="r-username" id="r-username">

            <label for="email">Email</label>
            <input required type="email" name="r-email" id="r-email">

            <label for="password">Password</label>
            <input required type="password" name="r-password" id="r-password">

            <div>
                <label for="info-password">Password Strength</label>
                <progress max="100" value="0" id="info-password"></progress>
            </div>
            <button class="button" type="submit">Register</button>
            <p id="password-message"></p>
        </form>
    </section>

<?php

    
    output_footer();
?>
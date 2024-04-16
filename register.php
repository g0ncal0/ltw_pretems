<?php 
    require_once('include.php');
    $session = new Session();

    $db = getDatabaseConnection();

    output_header($db, "Register", null, $session->getId());

?>



    <section class="container" >
        <h1>Register a new account</h1>
        <form class="account-form" action="actions/action_register.php" method="post">
            <label for="name">Name</label>
            <input type="text" name="r-name" id="r-name">


            <label for="email">Email</label>
            <input type="email" name="r-email" id="r-email">

            <label for="password">Password</label>
            <input type="password" name="r-password" id="r-password">

            <button class="button" type="submit">Register</button>
        </form>
    </section>

<?php

    
    output_footer();
?>
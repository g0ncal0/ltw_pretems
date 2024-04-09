<?php 
    require_once('templates/common.php');
    require_once('templates/profile.php');

    output_header("Register", null);

?>


<main>

    <section class="container" >
        <h1>Register a new account</h1>
        <form action="actions/action_register.php" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">


            <label for="email">Email</label>
            <input type="email" name="email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <button type="submit">Register</button>
        </form>
    </section>

</main>


<?php

    
    output_footer();
?>
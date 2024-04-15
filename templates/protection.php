<?php

session_start();

function protectPage() {
    if (!isset($_SESSION['id'])) {
        ?>
            <section class="container protectedpage">
                <h1>You found a protected page</h1>
                <p>Login or register to continue on this page!</p>
            </section>
        <?php
        // header("Location: register.php")
        exit;
    }
}


?>
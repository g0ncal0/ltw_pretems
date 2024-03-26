<?php 
    function output_header() { ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>PRELOVED</title>
            <!-- OTHER TAGS TO BE INSERTED HERE-->

            <meta name="description" content="preloved items with a twist">
            <link rel="stylesheet" href="normalize.css">

            <link rel="stylesheet" href="style.css">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">


        </head>
        <body>
            <section class="promotional">
                <span>Entregas Grátis para pedidos >50€</span>
            </section>
            <header>
                <span class="menu-header-shop">Menu</span>
                <div class="websiteheader">
                    <span>PRELOVED ITEMS</span>
                </div>
                <div class="svg-header"> 
                    <img class="elements-menu-header" src="img/profile-login.svg" alt="User Profile">
                    <img class="elements-menu-header" src="img/cart.svg" alt="Cart">
                </div>
            </header>
    <?php }

    function output_footer() { ?>
                    <footer>
                <p>&copy; PRELOVED ITEMS</p>
            </footer>
        </body>
        </html>
    <?php }
?>
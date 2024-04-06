<?php 
    function output_header() { ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>PRETEMS</title>
            <!-- OTHER TAGS TO BE INSERTED HERE-->

            <meta name="description" content="Preloved items with a twist">
            <link rel="stylesheet" href="normalize.css">

            <link rel="stylesheet" href="style.css">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="/js/index.js" defer></script>



        </head>
        <body>
            <section class="promotional">
                <span>Entregas Grátis para pedidos >50€</span>
            </section>
            <header>
                <span class="menu-header">Menu</span>
                <div class="websiteheader">
                    <a href="/"><span>PRETEMS</span></a>
                </div>
                <div class="svg-header"> 
                    <img id="open-profile" class="elements-menu-header" src="img/profile-login.svg" alt="User Profile">
                    <a href="/cart.php"><img class="elements-menu-header" src="img/cart.svg" alt="Cart"></a>
                </div>
            </header>
            <div class="menu"> <!-- MENU -->
                <span id="close-menu" >Close</span>
                <p class="logo-text">PRETEMS</p>
                <ul>
                    <li>sth</li>
                    <li id="m-category">Categories</li>
                    <ul>
                        <li>CAT 1</li>
                        <li>CAT 2</li>
                    </ul>
                    <li>sth</li>
                    <li>sth</li>
                </ul>
                <div>
                    <p>Welcome, {name}!</p>
                    <p>Sign Out</p>
                </div>
            </div>
            <div class="login-signup">
                <div>
                    <p id="close-login">Close</p>
                    <p>Get into your account</p>

                    <form action="action_login.php">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                        <button type="submit">Login</button>
                    </form>

                    <p>You can also signup</p>
                </div>
            </div>
    <?php }

    function output_footer() { ?>
        <footer>
            <p>&copy; PRETEMS</p>
        </footer>
        </body>
        </html>
    <?php }
?>
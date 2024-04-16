<?php 
    declare(strict_types=1);
    require_once(__DIR__ . '/mixed.php');
    function output_header($db, $pagetitle, $description) { ?>
        <!DOCTYPE html>
        <html>
        <head>
            <?php
            if($pagetitle != null){
                echo "<title>$pagetitle | PRETEMS</title>";
            }else{
                echo "<title>PRETEMS</title>";
            }
            ?>

            <!-- OTHER TAGS TO BE INSERTED HERE-->
            <?php
            if($description != null){
                echo "<meta name='description' content='$description'>";
            }else{
                echo "<meta name='description' content='The website where you will find pre-loved items with a twist!'>";
            }

            ?>
            <meta name="description" content="<?php echo $description ?>">
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
                <?php 
                    output_list_categories($db, "", "");
                ?>
                
                <form action="search.php" method="get">
                    <input type="text" name="s" title="s">
                    <button type="submit">🔎</button>
                </form>
                <div>
                    <p>Welcome, {name}!</p>
                    <p>Sign Out</p>
                </div>
            </div>
            <div class="login-signup">
                <div>
                    <p id="close-login">Close</p>
                    <p>Get into your account</p>

                    <form class="account-form" action="/actions/action_login.php" method="post">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                        <button class="button" type="submit">Login</button>
                    </form>

                    <p>You can also <a href="/register.php">signup</a></p>
                </div>
            </div>
            <main>
    <?php }

    function simpleheader($title){
        ?>
            <section class="header-content">
                <h1><?php echo $title ?></h1>
            </section>

        <?php
    }

    function output_footer() { ?>
        </main>
        <footer>
            <p>&copy; PRETEMS</p>
        </footer>
        </body>
        </html>
    <?php }
?>
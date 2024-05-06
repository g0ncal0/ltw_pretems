<?php 
    declare(strict_types=1);
    require_once(__DIR__ . '/mixed.php');
    require_once(__DIR__ . '/../session.php');

    function output_header($db, $pagetitle, $description, $user) { ?>
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
                    <a  href="/"><img class="logo-img" src="/img/logo.png"></a>
                </div>
                <div class="svg-header"> 
                    <img class="toggle-login elements-menu-header" src="img/profile-login.svg" alt="User Profile">
                    <a href="/cart.php"><img class="elements-menu-header" src="img/cart.svg" alt="Cart"></a>
                </div>
            </header>
            <div class="menu"> <!-- MENU -->
                <p id="close-menu" >Close</p>
                <img class="logo-img" src="/img/logo.png">
                <?php 
                    output_list_categories($db, "", "nolink");
                ?>
                
                <div class="svg-header"> 
                        <?php
                            if(isset($user)){
                                ?>
                                    <img class="act-logout elements-menu-header" src="img/logout.svg" alt="Log Out">
                                <?php
                            }
                        ?>
                        <img class="toggle-login elements-menu-header" src="img/profile-login.svg" alt="User Profile">
                        <a href="/cart.php"><img class="elements-menu-header" src="img/cart.svg" alt="Cart"></a>
                </div>
                
                
                <form  class="bottom-side-menu" action="items.php" method="get">
                    <input type="text" placeholder="Search (ENTER)" name="q" title="q">
                </form>
                
            </div>
            <div class="login-signup">
                <div>
                    <p class="toggle-login">Close</p>
                    <p>Get into your account</p>

                    <form id="login-form" class="account-form" action="/actions/action_login.php" method="post">
                        <label for="Lemail">Email Address</label>
                        <input type="email" id="Lemail" name="Lemail">
                        <label for="Lpassword">Password</label>
                        <input type="password" id="Lpassword" name="Lpassword">
                        <button id="login-submit" class="button" type="submit">Login</button>
                    </form>
                    <p id="sucess-login"></p>
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
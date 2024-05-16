<?php 
    declare(strict_types = 1);
    require_once(__DIR__ . '/mixed.php');
    require_once(__DIR__ . '/../session.php');

    function output_header(PDO $db, ?string $pagetitle, ?string $description, ?int $user, Session $session) : void { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
        <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
        <link rel="manifest" href="/img/site.webmanifest">
            <?php
            if($pagetitle != null){
                ?><title><?= $pagetitle ?> | PRETEMS</title><?php
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
            <meta charset="utf-8">
            <link rel="stylesheet" href="normalize.css">

            <link rel="stylesheet" href="style.css">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="/js/index.js" defer></script>



        </head>
        <body>
            <div class="promotional">
                <span>Use Code '1234' for 30% OFF</span>
            </div>
            <header>
                <span class="hover-underline special-font menu-header">Menu</span>
                <div class="websiteheader">
                    <a  href="/"><img class="logo-img" alt="The logo of pretems" src="/img/logo.png"></a>
                </div>
                <div class="svg-header"> 
                    <img class="toggle-login elements-menu-header" src="img/profile-login.svg" alt="User Profile">
                    <a href="/cart.php"><img class="elements-menu-header" src="img/cart.svg" alt="Cart"></a>
                </div>
            </header>
            <div class="menu"> <!-- MENU -->
                <span class="special-font hover-underline" id="close-menu" >Close</span>
                <img alt="The logo of pretems" class="logo-img" src="/img/logo.png">
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
                
                
                <form class="styled-input bottom-side-menu" action="items.php" method="get">
                    <input type="hidden" id="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

                    <input type="text" placeholder="Search (ENTER)" name="q" title="q">
                </form>
                
            </div>
            <div class="login-signup">
                <div>
                    <span class="special-font hover-underline toggle-login">Close</span>
                    <p>Get into your account</p>

                    <form id="login-form" class="account-form">
                        <input type="hidden" id="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>
                            
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

    function simpleheader(string $title) : void {
        ?>
            <section class="header-content">
                <h1><?php echo $title ?></h1>
            </section>

        <?php
    }

    function output_footer() : void { ?>
        </main>
        <footer>
            <p>&copy; PRETEMS</p>
        </footer>
        </body>
        </html>
    <?php }
?>
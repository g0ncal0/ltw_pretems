<?php 
    require_once('include.php');

    $session = new Session();

    $db = getDatabaseConnection();
    output_header($db, null, null, $session->getId());
?>

    <section class="home-box">
        <div>
            <h1>pretems.</h1>
            <p>The website where you can find preloved items with quality</p>
        </div>
    </section>


    <section class="container">
        <span class="special">You will love this...</span>
        <h2>Featured Items</h2>
        <?php output_list_items(getFeaturedItems($db), $db); ?>
    </section>
   
    <section class="container">
        <span>Search around! The perfect clothes are waiting for you!</span>
        <h2>All Categories</h2>
        <?php output_list_categories($db, "category-list", null);?>
    </section>


<?php
    output_footer();
?>
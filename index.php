<?php 
    require_once('include.php');

    $db = getDatabaseConnection();
    output_header($db, null, null);
?>
<main>
    <section class="home-box">
        <div>
            <h1>PRETEMS</h1>
            <p>The website where you can find preloved items with quality</p>
            <p>Pre-loved items you will adore at a price that will blow you away..</p>
        </div>
        <img src="">
    </section>

   
    <section class="container">
        <?php output_list_categories($db, "category-list", null);?>
    </section>
</main>

<?php
    output_footer();
?>
<?php 
    require_once('templates/common.php');
    require_once('templates/home.php');

    output_header(null, null);
?>
<main>
    <section class="box home-box">
        <div>
            <h1>PRETEMS</h1>
            <p>The website where you can find preloved items with quality</p>
            <p>Pre-loved items you will adore at a price that will blow you away..</p>
        </div>
        <img src="">
    </section>

    <?php output_featured() ?>

    <?php output_categories() ?>

</main>

<?php
    output_footer();
?>
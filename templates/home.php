<?php 
    require_once('templates/items.php');

    function output_home_page() { ?>
        <main>
            <section class="box home-box">
                <div>
                    <h1>PRETEMS</h1>
                    <p>The website where you can find preloved items with quality</p>
                </div>
                <img src="">
            </section>

            <?php output_featured() ?>

            <section class="container">
                <h2>Shop by <span class="special">category</span></h2>
                <ul class="category-list">
                    <li><a href="">CATEGORY 1</a></li>
                    <li><a href="">CATEGORY 2</a></li>
                    <li><a href="">CATEGORY 3</a></li>
                </ul>
            </section>
        </main>
    <?php }

    function output_featured() { ?>
        <section class="container">
            <h2><span class="special">Featured</span> Items</h2>
            <?php output_list_items(); ?>
        </section>
    <?php }
?>
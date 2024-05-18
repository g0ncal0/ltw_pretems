<?php
    declare(strict_types = 1);

    /* Add category */
    function output_category_form($session) : void { ?>
        <form class="category-form" action="/actions/action_add_by_admin.php?add=category" method="post">
            <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" required>    
            <button class="button" type="submit" value="Add Category">Add Category</button>
        </form>
    <?php }

    function output_existing_categories(?array $categories) : void { 
        ?><h2>Existing categories</h2>
        <ul><?php
            foreach ($categories as $category) {
                echo '<li>' . $category['name'] . '</li>';
            }
        ?></ul>
    <?php } 

    /* Add size */
    function output_size_form(Session $session) : void { ?>
        <form class="size-form" action="/actions/action_add_by_admin.php?add=size" method="post">
            <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

            <label for="name">Size Name:</label>
            <input type="text" id="name" name="name" required>    
            <button class="button" type="submit" value="Add Size">Add Size</button>
        </form>
    <?php }
    
    function output_existing_sizes(?array $sizes) : void { 
        ?><h2>Existing sizes</h2>
        <ul><?php
            foreach ($sizes as $size) {
                echo '<li>' . $size['name'] . '</li>';
            }
        ?></ul>
    <?php }
    
    /* Add condition */
    function output_condition_form($session) : void { ?>
        <form class="condition-form" action="/actions/action_add_by_admin.php?add=condition" method="post">
            <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

            <label for="name">Condition Name:</label>
            <input type="text" id="name" name="name" required>    
            <button class="button" type="submit" value="Add Condition">Add Condition</button>
        </form>
    <?php }

    /* Add brand */
    function output_brand_form($session) : void { ?>
        <form class="brand-form" action="/actions/action_add_by_admin.php?add=brand" method="post">
            <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

            <label for="name">Brand Name:</label>
            <input type="text" id="name" name="name" required>    
            <button class="button" type="submit" value="Add Condition">Add Brand</button>
        </form>
    <?php }
    
    function output_existing_conditions($conditions) : void {  
        ?><h2>Existing conditions</h2>
        <ul><?php
            foreach ($conditions as $condition) {
                echo '<li>' . $condition['name'] . '</li>';
            }
        ?></ul>
    <?php } 

    function output_existing_brands($brands) : void {  
        ?><h2>Existing brands</h2>
        <ul><?php
            foreach ($brands as $brand) {
                echo '<li>' . $brand['name'] . '</li>';
            }
        ?></ul>
    <?php } 

?>
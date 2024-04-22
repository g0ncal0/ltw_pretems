<?php
    /* Add category */
    function output_category_form() { ?>
        <form class="category-form" action="/actions/action_add_by_admin.php?add=category" method="post">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" required>    
            <button class="button" type="submit" value="Add Category">Add Category</button>
        </form>
    <?php }

    function output_existing_categories() { 
        $db = getDatabaseConnection();
        $categories = getCategories($db);

        ?><h2>Existing categories</h2>
        <ul><?php
            foreach ($categories as $category) {
                echo '<li>' . $category['name'] . '</li>';
            }
        ?></ul>
    <?php } 

    /* Add size */
    function output_size_form() { ?>
        <form class="size-form" action="/actions/action_add_by_admin.php?add=size" method="post">
            <label for="name">Size Name:</label>
            <input type="text" id="name" name="name" required>    
            <button class="button" type="submit" value="Add Size">Add Size</button>
        </form>
    <?php }
    
    function output_existing_sizes() { 
        $db = getDatabaseConnection();
        $sizes = getSizes($db);
        
        ?><h2>Existing sizes</h2>
        <ul><?php
            foreach ($sizes as $size) {
                echo '<li>' . $size['name'] . '</li>';
            }
        ?></ul>
    <?php }
    
    /* Add condition */
    function output_condition_form() { ?>
        <form class="condition-form" action="/actions/action_add_by_admin.php?add=condition" method="post">
            <label for="name">Condition Name:</label>
            <input type="text" id="name" name="name" required>    
            <button class="button" type="submit" value="Add Condition">Add Condition</button>
        </form>
    <?php }
    
    function output_existing_conditions() { 
        $db = getDatabaseConnection();
        $conditions = getConditions($db);
        
        ?><h2>Existing conditions</h2>
        <ul><?php
            foreach ($conditions as $condition) {
                echo '<li>' . $condition['name'] . '</li>';
            }
        ?></ul>
    <?php } 

?>
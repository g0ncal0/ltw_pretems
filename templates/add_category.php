<?php
    function output_category_form() { ?>
        <form class="category-form" action="/actions/action_add_category.php" method="post">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" required>    
            <button class="button" type="submit" value="Add Category">Add Category</button>
        </form>
    <?php }

    function output_existing_categories($categories) { ?> 
        <h2>Existing categories</h2>
        <ul><?php
            foreach ($categories as $category) {
                echo '<li>' . $category['name'] . '</li>';
            }
        ?></ul>
    <?php } 

?>
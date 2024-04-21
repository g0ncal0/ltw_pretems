<?php

function output_size_form() { ?>
    <form class="size-form" action="/actions/action_add_size.php" method="post">
        <label for="name">Size Name:</label>
        <input type="text" id="name" name="name" required>    
        <button class="button" type="submit" value="Add Size">Add Size</button>
    </form>
<?php }

function output_existing_sizes($sizes) { ?> 
    <h2>Existing sizes</h2>
    <ul><?php
        foreach ($sizes as $size) {
            echo '<li>' . $size['name'] . '</li>';
        }
    ?></ul>
<?php } 


?>
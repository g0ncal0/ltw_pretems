<?php 
    require_once('include.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $categories = getCategories($db);
    $brands = getBrands($db);
    $sizes = getSizes($db);
    $conditions = getConditions($db);

    output_header($db, 'Add Product', null, $session->getId()); 
    protectPage();
    ?>


    <section class="container">
        <h1>Add Product:</h1>
        <form class="profile-form" action="/actions/action_add_product.php" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php
                foreach ($categories as $category) {
                    echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                }
                ?>
            </select>

            <label for="brand">Brand:</label>
            <select id="brand" name="brand">
                <?php
                foreach ($brands as $brand) {
                    echo "<option value='" . $brand['id'] . "'>" . $brand['name'] . "</option>";
                }
                ?>
            </select>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required>

            <label for="size">Size:</label>
            <select id="size" name="size" required>
                <?php
                foreach ($sizes as $size) {
                    echo "<option value='" . $size['id'] . "'>" . $size['name'] . "</option>";
                }
                ?>
            </select>

            <label for="condition">Condition:</label>
            <select id="condition" name="condition">
                <?php
                foreach ($conditions as $condition) {
                    echo "<option value='" . $condition['id'] . "'>" . $condition['name'] . "</option>";
                }
                ?>
            </select>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" pattern="\d+(\.\d{2})?" title="price" placeholder="ex: 9.99" required>

            <label for="available">Available:</label>
            <input type="checkbox" id="available" name="available" checked="false">

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" cols="50"></textarea>

            <label for="images">First Picture:</label>
            <input type="file" name="images" multiple>

            <button class="button" type="submit">Add Product</button>
        </form>
    </section>  

    <?php output_footer();
?>
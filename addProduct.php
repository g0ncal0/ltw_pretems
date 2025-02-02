<?php 
    require_once('include.php');

    $session = new Session();

    $db = getDatabaseConnection();

    $categories = getCategories($db);
    $brands = getBrands($db);
    $sizes = getSizes($db);
    $conditions = getConditions($db);

    output_header($db, 'Add Product', null, $session->getId()); 
    protectPage($session);


    function printOptions($elements){
        foreach($elements as $element){
            ?>
                <option value="<?php echo $element['id']?>"><?php echo $element['name']?></option>
            <?php
        }
    }



    ?>


    <section class="container">
        <h1>Add Product:</h1>
        <form class="product-form" action="/actions/action_add_product.php" method="post" enctype="multipart/form-data">
            <input type="hidden" class="csrf" name="csrf" value=<?php echo $session->getCSRF() ?>>

            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php printOptions($categories); ?>
            </select>

            <label for="brand">Brand:</label>
            <select id="brand" name="brand" required>
                <?php printOptions($brands); ?>
            </select>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required>

            <label for="size">Size:</label>
            <select id="size" name="size" required>
                <?php printOptions($sizes); ?>
            </select>

            <label for="condition">Condition:</label>
            <select id="condition" name="condition" required>
                <?php printOptions($conditions) ?>
            </select>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" pattern="\d+(\.\d{1,2})?" title="price" placeholder="ex: 9.99" required>

            <label for="available">Available:</label>
            <input type="checkbox" id="available" name="available" checked="false">

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5" cols="50" required></textarea>

            <label for="firstImg">First Picture:</label>
            <input type="file" name="firstImg" required>

            <label for="images">More Pictures:</label>
            <input type="file" name="images[]" multiple>

            <button class="button" type="submit">Add Product</button>
        </form>
    </section>  

    <?php output_footer();
?>